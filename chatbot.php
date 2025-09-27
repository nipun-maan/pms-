<?php
include 'db.php';
session_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }

$faq_result = $conn->query("SELECT * FROM chatbot_faq ORDER BY faq_id ASC");
?>

<div class="content">
<h2>Hospital ChatBot / FAQ</h2>
<p>Click a question to see the answer:</p>
<ul id="faqList">
<?php while($row = $faq_result->fetch_assoc()){ ?>
<li class="faq-item">
    <span class="question"><?php echo $row['question']; ?></span>
    <div class="answer" style="display:none; margin-top:5px;"><?php echo $row['answer']; ?></div>
</li>
<?php } ?>
</ul>
</div>

<script>
const faqs = document.querySelectorAll('.faq-item');
faqs.forEach(faq => {
    faq.querySelector('.question').addEventListener('click', () => {
        const ans = faq.querySelector('.answer');
        ans.style.display = ans.style.display==='none'?'block':'none';
    });
});
</script>

<style>
.faq-item{ padding:10px; border-bottom:1px solid #ccc; cursor:pointer; }
.faq-item:hover{ background:#f0f0f0; }
.question{ font-weight:bold; }
.answer{ color:#555; }
</style>
