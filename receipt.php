<?php
session_start();
if ( !isset($_SESSION['username']) && !isset($_SESSION['password']) ) {
    header('location: login');
} else {
    
    require_once 'connect.php';
    require('fpdf/fpdf.php'); // Include the FPDF library

    if ( !isset($_POST['ref']) || isset($_POST['ref']) =="" || empty($_POST['ref'])) {
        echo "<script> alert('Receipt Could Not Be Generated !!!'); window.location='payment_history' </script>";
    } else {

        $memberID   = $_SESSION['memberId'];
        $ref        =   trim($_POST['ref']);
        $PRecps     =   mysqli_query($db, "SELECT *, 
                                        u.othername, u.lastname, rc.category_name, ph.amount_paid, ph.reference, ph.transaction_id, ph.status, ph.created_at
                                        FROM payment_history ph
                                        INNER JOIN users u
                                        ON u.member_reg_no=ph.member_id
                                        INNER JOIN reg_category rc
                                        ON u.category= rc.category_id
                                        WHERE ph.member_id='$memberID' AND ph.reference='$ref'
                                        AND ph.transaction_id !=''
                                        AND ph.reference !=''");
        
        if (mysqli_num_rows($PRecps) > 0) {
            $PRecp  =   mysqli_fetch_array($PRecps);
            $fname  =   $PRecp['lastname'] . ' ' . $PRecp['othername'];
            $amt    =   number_format($PRecp['amount_paid'], 2);
            $desc   =   $PRecp['category_name'];
            $trn    =   $PRecp['transaction_id'];
            $date   =   date('F g, Y', strtotime($PRecp['created_at']));
            $qrdata =   $memberID . $PRecp['lastname'] . '_' . $PRecp['category_name'] . '_' . $PRecp['amount_paid'];
            $qrCodeUrl = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($qrdata);

            // Ensure that the local file path for the QR code image is valid
            $qrImagePath = 'qrimages/qrcode.png';

            // Create directory if not exist ...............
            if ( !file_exists($qrImagePath)) {
                mkdir('qrimages/', 0777, true);
            }

            // Download the QR code image from the URL and save it to the local file path
            file_put_contents($qrImagePath, file_get_contents($qrCodeUrl));

            // Create a PDF object
            $pdf = new FPDF();
            $pdf->AddPage();

            // Adding background Images
            // $pdf->Image('admin/assets/images/favicon.png', 0, 0, 210, 297);

            $pdf->AddFont('Times-Roman', '', 'times.php');
            $pdf->AddFont('Times-Roman', 'B', 'times.php');
            $pdf->AddFont('Times-Roman', 'I', 'times.php');
            // Set font
            $pdf->SetFont('Arial', 'B', 16);

            // Adding heading logo and school name
            $pdf->Image('images/mulan_icon.png', 10, 12, 18, 18);

            $pdf->SetXY(30, 10);
            $pdf->Cell(0, 10, 'MUSLIM LAWYERS\' ASSOCIATION OF NIGERIS (MULAN).', 0, 1, 'L');

            $pdf->SetFont('Arial', '', 14);
            $pdf->SetXY(30, 17);
            $pdf->Cell(0, 10, '15 Annual General Conference Ibadan 2024', 0, 1, 'L');

            $pdf->SetXY(30, 24);
            $pdf->Cell(0, 10, 'University of Ibadan, Ibadan Oyo State.', 0, 1, 'L');

            $pdf->SetFont('Arial', 'B', 14);
            // Add content to the PDF
            $pdf->SetXY(0, 30);
            $pdf->Cell(0, 20, 'PAYMENT RECEIPT', 0, 1, 'C'); // Title

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(40, 10, 'Payment Reference:', 0);
            $pdf->Cell(60, 10, $ref, 0, 1);

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(40, 10, 'Transaction ID:', 0);
            $pdf->Cell(60, 10, $trn, 0, 1);

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(40, 10, 'Member Name:', 0);
            $pdf->Cell(60, 10, $fname, 0, 1);

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(40, 10, 'Tag Number:', 0);
            $pdf->Cell(60, 10, $memberID, 0, 1);

            $pdf->Cell(40, 10, 'Payment Date:', 0);
            $pdf->Cell(60, 10, $date, 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Payment Description', 0, 1, 'L');

            $pdf->Line($pdf->GetX(), $pdf->GetY(20), $pdf->GetX() + 180, $pdf->GetY()); // Adjust the length as needed
            $pdf->Ln(4); 

            $pdf->Cell(30, 10, 'Year:', 0);
            $pdf->Cell(60, 10, date('Y'), 0, 1);

            $pdf->Cell(30, 10, 'Amount:', 0);
            $pdf->Cell(50, 10, 'N'. $amt, 0, 1);

            $pdf->Cell(30, 10, 'Category', 0);
            $pdf->Cell(50, 10, $desc, 0, 1);

            $pdf->Line($pdf->GetX(), $pdf->GetY(20), $pdf->GetX() + 180, $pdf->GetY()); // Adjust the length as needed
            $pdf->Ln(5); 

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(0, 10, 'This receipt has been verified.', 0);

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(0, 10, '', 0, 1, 'L'); // Text above the line

            $pdf->SetFont('Times-Roman', '', 12);
            $pdf->Cell(0, 15, '', 0, 1, 'L');

            // Embed the locally saved QR code image
            $pdf->Image($qrImagePath, 10, 160, 40, 40);
            
            ob_end_clean();

            // Output the PDF
            $pdf->Output('receipt.pdf', 'I');

            // Clean up: You can optionally delete the locally downloaded image if no longer needed
            unlink($qrImagePath);

        }

  }
}
?>