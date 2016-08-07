
<?php
	function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    else
    {
        echo "<script type='text/javascript'>document.location.href='".$url."';</script>";
    }

    exit();
}

Redirect('https://play.google.com/store/apps/details?id=com.diver.diver', false);
?>
