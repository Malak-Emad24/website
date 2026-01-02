document.getElementById('confirm-order').addEventListener('click', function(){
    document.getElementById('modal-bg').style.display = 'flex';
});

document.getElementById('no-btn').addEventListener('click', function(){
    document.getElementById('modal-bg').style.display = 'none';
});

document.getElementById('yes-btn').addEventListener('click', function(){
    document.getElementById('modal-bg').style.display = 'none';
    document.getElementById('thanks-bg').style.display = 'flex';
});

document.getElementById('thanks-ok').addEventListener('click', function(){
    document.getElementById('thanks-bg').style.display = 'none';
    // هنا ممكن تضيف كود PHP لإرسال الطلب أو redirect
});

