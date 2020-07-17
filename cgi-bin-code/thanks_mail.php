<?php

require_once('tcpdf_include.php');

function _generatePDF($donor_name = '', $donation_amount = '', $donation_date = '') {

  // create new PDF document
  $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

  $pdf->SetCreator('Kolkata Foundation');
  $pdf->SetAuthor('Dhritiman Banerjee');
  $pdf->SetTitle('Thank you from Kolkata Foundation');
  $pdf->SetSubject('Thank you for your donation');

  // set default header data
  $pdf->SetHeaderData('logo.png', 50);
  $pdf->SetDefaultMonospacedFont('courier');
  $pdf->SetMargins(15, 30, 15); // Left Top Right
  $pdf->SetHeaderMargin(5);
  $pdf->SetFooterMargin(10);
  $pdf->SetAutoPageBreak(TRUE, 25);
  $pdf->setImageScale(1.25);
  $pdf->setFontSubsetting(true);
  $pdf->SetFont('times', '', 12, '', true);

  $pdf->AddPage();

  $html = <<<EOD

<h1>Thank you for your Donation - Tax Receipt</h1>

<p>Dear $donor_name,</p><br/>

<p>On behalf of the Board of Trustees and the beneficiaries of Kolkata Foundation, I thank you
for your generous donation of $$donation_amount on $donation_date. Your entire donation 
will go towards supporting social impact efforts in West Bengal.</p><br/>

<p>Would you like to multiply the impact of your donation?</p>

<p>Kolkata Foundation is a US 501(c)3 organization (Tax Id # 81-4479308)and many employers match
the charitable contributions of their employees to registered nonprofits. We are registered on 
platforms like Benevity (available to 12 million employees), YourCause (available to 8 million 
employees), and also directly with many other employers to receive matching donations. In addition, 
we are happy to register with your employer if required. Please check if you can activate a matching
donation from your employer. You may furnish this receipt to claim your match.</p><br/>

<p>We understand that there are many worthy non-profits that vie for your attention, and we
appreciate you making us a part of your philanthropic initiatives. We work hard to ensure
that all funds collected are sent to highly credible NGOs, and we work closely with them in
order to scale their impact.</p><br/>

<p>Please follow our story on Facebook 
at <a href="www.facebook.com/kolkatafoundation" target="_blank">www.facebook.com/kolkatafoundation</a> 
and read more about us at <a href="www.kolkatafoundation.org" target="_blank">www.kolkatafoundation.org</a>.
</p><br/>

<p>Your contribution is tax-deductible to the extent allowed by law. No goods or services were provided in
exchange for your generous financial donation.</p><br/>

<p>We look forward to your continued support.</p><br/>
Sincerely,
EOD;

  // Print text using writeHTMLCell()
  $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

  $image_file = K_PATH_IMAGES.'nitin-signature.png';
  $pdf->Image($image_file, '', '', 30, '', 'PNG', '', 'N', false, 300, '', false, false, 0, false, false, false);

  $pdf->writeHTMLCell(0, 0, '', '', 'Nitin Kotak<br/>Trustee and Treasurer', 0, 1, 0, true, '', true);

  return $pdf->Output('', 'E');
}

function send_thanks($to, $donor_name, $donation_amount, $recurring='', $volunteer_name=null, $volunteer_email=null) {

  $from      = "info@kolkatafoundation.org";
  $treasurer = "nitinkotakkf@gmail.com";
  $subject   = "TEST: Automatic Thank you from Kolkata Foundation";
  $file_name = "Kolkata Foundation Donation Receipt.pdf";
  $donation_date = date("F j, Y");

  $cc_string = "Cc: $treasurer";
  $volunteer_string = "";

  if (!is_null($volunteer_email)) {
     $cc_string = $cc_string . "," . $volunteer_email;  
     $volunteer_string = ", as part of the fundraiser organized by " . $volunteer_name; 
  }
  $cc_string .= "\r\n";

  $message = <<<MARKER

Dear $donor_name,

Thank you for your generous $recurring donation of $$donation_amount to Kolkata Foundation$volunteer_string. 

As a registered 501 c(3) organization (Tax Id # 81-4479308), your donation is tax deductible. This email 
serves as a receipt for your donation. Your entire donation will go towards supporting our causes in Kolkata.

Please check if your employer will match your donation. We are already enrolled with Benevity and 
YourCause in order to help this process (and happy to join other platforms). A list of participating
companies who have already matched is at https://www.kolkatafoundation.org/corporate-donation-match/.

You can follow us at https://www.facebook.com/kolkatafoundation to learn about our projects and 
the impact of your donations. 100% of our administrative costs are borne by our founders, so 
that your donation can go towards helping those with the greatest need.

We appreciate you spreading the word amongst your friends -- come join us to build a global
community working together to make a difference.

With gratitude,
The Kolkata Foundation team

PS: Contact us at info@kolkatafoundation.org to start your own fundraiser.
MARKER;

    $file_attachment = _generatePDF($donor_name, $donation_amount, $donation_date);

    $mime_boundary = md5("random");
 
    // Headers for attachment  
    $headers  = "From: $from" . "\r\n" . $cc_string .  "Reply-to: $from" . "\r\n";
    $headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

    // Multipart boundary  
    $body = "--$mime_boundary\r\n"; 
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n"; 
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";  
    $body .= chunk_split(base64_encode($message));  
    $body .= "\r\n\r\n";
          
    //attachment 
    $body .= "--$mime_boundary\r\n"; 
    $body .="Content-Type: application/pdf; name=".$file_name."\r\n"; 
    $body .="Content-Disposition: attachment; filename=".$file_name."\r\n"; 
    $body .="Content-Transfer-Encoding: base64\r\n"; 
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";  
    $body .= $file_attachment; // Attaching the encoded file with email 

    $body .= "--{$mime_boundary}--"; 
  
    $mail_sent = mail($to, $subject, $body, $headers);
    return $mail_sent;
}
