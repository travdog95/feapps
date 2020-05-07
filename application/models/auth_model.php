<?php
defined('BASEPATH') OR exit('No direct script access allowed.');

class Auth_model extends CI_Model {
	
    var $client_service = "frontend-client";
    var $auth_key = "simplerestapi";

    public function check_auth_client()
    {
        $client_service = $this->input->get_request_header('Client-Service', true);
        $auth_key = $this->input->get_request_header('Auth-Key', true);

        if ($client_service == $this->client_service && $auth_key == $this->auth_key)
        {
            return true;
        }
        else
        {
            return json_output(401, array('status' => 401, 'message' => 'Unauthorized.'));
        }
    }

    public function login($user_name, $password)
    {
        $query = $this->db
            ->select('Password, User_Idn')
            ->from("Users")
            ->where("UserName", $user_name)
            ->get()->row();

        if ($query == "")
        {
            return array('status' => 204, 'message' => 'Username not found.');
        }
        else
        {
            if ($query->Password == $password)
            {
                $last_login = date("Y-m-d H:i:s");
                $token = crypt(substr(md5(rand()), 0, 7));
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->trans_start();
                //$this->db->where('User_Idn', $query->User_Idn)->update('Users', array('last_login' => $last_login));
                $this->db->insert('UserAuthentications', array('User_Idn' => $query->User_Idn, 'Token' => $token, 'ExpiredAt' => $expired_at));

                if ($this->db->trans_status() === false)
                {
                    $this->db->trans_rollback();
                    return array('status' => 500, 'message' => 'Intnernal server error.');
                }
                else
                {
                    $this->db->trans_commit();
                    return array('status' => 200, 'message' => 'Successfully logged in.', 'id' => $query->User_Idn, 'token' => $token);
                }
            }
            else
            {
                return array('status' => 204, 'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $user_idn = $this->input->get_request_header('User-ID', true);
        $token = $this->input->get_request_header('Authorization', true);
        $where = array(
            'User_Idn' => $user_idn,
            'Token' => $token
        );

        if ($this->db->delete("UserAuthentications", $where))
        {
            return array('status' => 200, 'message' => "Successfully logged out.", 'token' => $token, 'user-id' => $user_idn);
        }
        else
        {
            return array('status' => 204, 'message' => 'Session not deleted.');
        }
    }

    // public function auth()
    // {
    //     $user_idn = $this->input->get_request_header('User-ID', true);
    //     $token = $this->input->get_request_header('Authorization', true);

    //     $query = $this->db
    //         ->select('ExpiredAt')
    //         ->from('UserAuthentications')
    //         ->where('User_Idn', $user_idn)
    //         ->where('Token', $token)
    //         ->get()-row();

    //     if ($query == "")
    //     {
    //         return json_output(401, array('status' => 401, 'message' => 'Unauthorized.'));
    //     }
    //     else
    //     {
    //         if ($query->ExpiredAt < date('Y-m-d H:i:s'))
    //         {
    //             return json_output(401, array('status' => 401, 'message' => 'Your session has expired.'));
    //         }
    //         else
    //         {
    //             $updated_at = date('Y-m-d H:i:s');
    //             $expired_at = date('Y-m-d H:i:s', strtotoime('+12 hours'));
    //             $this->db
    //                 ->where('User_Idn', $user_idn)
    //                 ->where('Token', $token)
    //                 ->update('UserAuthentications', array('ExpiredAt' => $expired_at));
    //             return array('status' => 200, 'message' => 'Authorized.');
    //         }
    //     }
    // }
}