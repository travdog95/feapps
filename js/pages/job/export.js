function export_accounting_data() {

  const job_numbers = [FECI.job.job_number];

  const query_string = job_numbers.map(function(el, idx) {
    return 'job_numbers[' + idx + ']=' + el;
  }).join('&');

  window.location.href = FECI.base_url + 'export/accounting/?' + query_string;
}       
