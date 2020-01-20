<!-- Roistat code -->
<script>
(function(w, d, s, h, id) {
    w.roistatProjectId = id; w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
    var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
})(window, document, 'script', 'cloud.roistat.com', '5fe1bb3e4eb36ce04ca08253c3f8c2bb');
</script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $(function () {
        
        $('#comp-ioisxnlgsubmit').on('click', function () {
            console.log('sending', 'in process'); 
            var name    = $('#field1').val();
            var email   = $('#field2').val();
            var phone   = $('#field3').val();
            var subject = $('#field4').val();
            var comment = $('#comp-ioisxnlgfieldMessage').val(); 
            if(phone.length != 0 && email.length != 0 ) {
                console.log('sending', 'is ok');
                roistatGoal.reach({
                    leadName: 'Новый лид с формы: Обратной связи',
                    name: name,
                    phone: phone,
                    email: email,
                    text: comment, 
                    fields: {
                        subject: subject
                    }
                });
            }

        })
    })
</script>
<!-- End roistat -->