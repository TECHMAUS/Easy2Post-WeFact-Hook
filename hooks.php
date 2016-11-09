<?php

/*
 *  Easy2Post webhook WeFact Hosting 
 *  09-11-2016 versie 0.1
 * 
 *  Auteur: TECHMAUS
 *
 */

/** add action hooks **/
add_action('invoice_is_sent', 'sent_by_easy2post');
add_action('invoice_reminder_is_sent', 'sent_by_easy2post');
add_action('invoice_summation_is_sent', 'sent_by_easy2post');


/** execute action hooks **/
function sent_by_easy2post($parameters) {
	if($parameters['viaPost']) {

		require_once("easy2post.api.php");

		$api_easy2post = new easy2postapi();
		$invoice_id = $parameters['id'];
		$invoiceParams = array(
				'Identifier'	=> $invoice_id,
		);

		$invoice_data = internalAPI('invoice', 'show', $invoiceParams);
		$invoice_pdf = internalAPI('invoice', 'download', $invoiceParams);   
	
		// Set temp filepath where to write pdf file to
		$invoice_tmppath = $_SERVER['DOCUMENT_ROOT'].'Pro/temp/'.$invoice_pdf["invoice"]["Filename"];

		// Create and open tempfile
		$fopen = fopen ($invoice_tmppath,'a+b');

		// Decode base64 data from api
		$invoice_base64 = base64_decode ($invoice_pdf["invoice"]["Base64"]); 

		// Write data back to pdf file
		fwrite ($fopen,$invoice_base64); 

		// Close output file
		fclose ($fopen); 	
	
		// Upload to easy2post api
			try {
					$api_easy2post->adres = $invoice_data['Address'];
					$api_easy2post->postcode = $invoice_data['ZipCode'];
					$api_easy2post->plaats = $invoice_data['City'];
					$api_easy2post->naam = $invoice_data['Initials'] . " " . $invoice_data['Surname'] ;
					$api_easy2post->pdffile = $invoice_tmppath;
					$api_easy2post->printadres = false;
					$api_easy2post->fullcolor = true;
					$api_easy2post->aangetekend = false;
				 flashMessage($api_easy2post->uploadPDF());
			} catch (Exception $e) {
					flashMessage($e->getMessage());
			}

}}

?>
