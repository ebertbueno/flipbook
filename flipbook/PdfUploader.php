<?php/*File		: PdfUploader.phpCreated		: 20/02/2014Modified	: 20/02/2014Author		: kpsujeesh@gmail.comDescription	: This file uploads the pdf file to the server and*/include "Root.php";$MaxSize = 102400000000;$files = glob('./book/*'); //get all file namesforeach($files as $file){	if (is_file($file)) unlink($file); //delete previous files and images from the directory}if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pdf_uploader'])){	if (is_uploaded_file($_FILES['pdffile']['tmp_name']))	{		if (strtoupper(pathinfo($_FILES['pdffile']['name'], PATHINFO_EXTENSION)) != "PDF") //check for pdf file		{			echo '<script>alert("Not a PDF File.");</script>';		}		else		if ($_FILES['pdffile']['size'] > $MaxSize) //check for file size		{			echo '<script>alert("File size exeeded.");</script>';		}		else		{			$RandFileName = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ") , 0, 15); //Randome file name generation			$Result = move_uploaded_file($_FILES['pdffile']['tmp_name'], $RootPath . $RandFileName . ".pdf"); //Move file to $RootDoc directory			if ($Result == 1)			{				header('Location: ./flipbook.html?file=' . $RandFileName);			}			else			{				echo '<script>alert("Faild to Upload File.");</script>';			}		}	}}?>