<?php
include('header.php');
?>

<style>
    body {
        background-color: #FFDFEF;
        font-family: 'Segoe UI', sans-serif;
        color: #4B0082;
        margin: 0;
        padding: 0;
    }

    .contact-container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #EABDE6;
        border: 2px solid #D69ADE;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 8px 20px rgba(170, 96, 200, 0.2);
    }

    h2 {
        text-align: center;
        color: #AA60C8;
        font-size: 2.2em;
        margin-bottom: 20px;
    }

    p, li {
        font-size: 1.1em;
        line-height: 1.8;
        color: #5C2C91;
    }

    ul {
        padding-left: 20px;
    }

    .site-footer {
        background-color: #D69ADE;
        color: white;
        text-align: center;
        padding: 20px 0;
        margin-top: 60px;
        font-size: 0.95em;
    }

    .site-footer a {
        color: white;
        margin: 0 12px;
        text-decoration: none;
        font-weight: bold;
    }

    .site-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>We'd love to hear from you! If you have any questions, feedback, or just want to say hello, you can reach us through the following:</p>
    <ul>
        <li><strong>Email:</strong> hello@lostinthecup.com</li>
        <li><strong>Phone:</strong> +60 12-345 6789</li>
        <li><strong>Address:</strong> Lot 27, Jalan Kopi Manis, 43000 Kajang, Selangor</li>
    </ul>
</div>

<?php
include('footer.php');
?>

