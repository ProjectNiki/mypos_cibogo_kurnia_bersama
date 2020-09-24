<?php

class Fungsi
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
	}

	function user_login()
	{
		$this->ci->load->model('Users_m');
		$user_id     = $this->ci->session->userdata('user_id');
		$user_data   = $this->ci->Users_m->get($user_id)->row();
		return $user_data;
	}

	function PdfGenerator($html, $filename, $paper)
	{
		$options = new Dompdf\Options();
		$options->set('isRemoteEnabled', TRUE);

		$dompdf = new Dompdf\Dompdf($options);

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('$paper', 'landscape');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream($filename, array('Attachment' => 0));
	}
}
