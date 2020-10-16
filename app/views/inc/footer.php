<!-- footer part start-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="/js/lib/croppie.js"></script> 
    
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=<?= SITE_PUBLIC_KEY ?>"></script>
    <script>      
        const recaptchaResponseElt =  document.getElementById('recaptchaResponse');
        const recaptchaResponseRegisterElt = document.getElementById('recaptchaResponseRegister');
        
        if (window.location.href == "<?= URLROOT.'/'; ?>")
        {   
            if(recaptchaResponseElt){
                grecaptcha.ready(function() {
                    grecaptcha.execute('6LfByrEUAAAAAEwNWQYqCAd3zcF_DFUep9VuKEi0', { action: 'contact'})
                    .then(function (token){             
                        recaptchaResponseElt.value = token;               
                    });
                });
            }
        
        }
        
        if (window.location.href == "<?= URLROOT.'/pages/inscription'; ?>")
        {   
            if (recaptchaResponseRegisterElt){
                grecaptcha.ready(function() {        
                    grecaptcha.execute('6LfByrEUAAAAAEwNWQYqCAd3zcF_DFUep9VuKEi0', { action: 'register'}).then(function (token){          
                        recaptchaResponseRegisterElt.value = token;
                    }); 
                });
            }
        }   
    </script>
    <script src="https://js.stripe.com/v3/"></script>
</body>
</html>
<?php unset($_SESSION['errors']); ?>
<?php unset($_SESSION['data']); ?>
<?php unset($_SESSION['flash']); ?>