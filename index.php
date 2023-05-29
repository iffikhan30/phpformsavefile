<!doctype html>

<html lang="en">
    
<head>
    <!--Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world! here</title>
</head>
    
<body>

<section class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form name="contactform" id="contactform" class="formsavefile">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="hidden" name="formname" value="contactform"/>
                        <input type="text" class="form-control" id="name" name="name" value="Robet Jay" placeholder="Enter Name"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" value="robetjay@gmail.com" placeholder="Enter email"/>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="phone" value="0569592248" placeholder="Enter Phone"/>
                    </div>
                     <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="Near MOE" placeholder="Enter address"/>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" placeholder="Tell us about your project">Tell us about your project</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
</section>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="jquery.validate.js"></script>
<script>
    $(document).ready(function () {

        $("#contactform").validate({
            ignore: ":hidden",
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    minlength: 3
                },
                phone: {
                    required: true
                },
                message: {
                    required: true,
                    minlength: 10
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "form.php",
                    data: $(form).serialize(),
                    success: function (response) {
                        data = JSON.parse( response );
                        if(data.success === true){
                            let name = data.data.name;
                            let email = data.data.email;
                            let phone = data.data.phone;
                            let message = data.data.message;
                            window.open("https://wa.me/"+phone+"?text="+"Name : "+name+"%0a"+"Email : "+email+"%0a"+"Phone : "+phone+"%0a"+"Message : "+message,"_blank").focus();
                            $('.formsavefile').append("<h4 class='savefile-message'>We’re thrilled to hear from you. One of our awesome consultants will get in touch with you soon.<br/>All the best,<br/></h4>");
                            $('.savefile-message').fadeOut("slow");
                        }else if(data.success === false){
                            $('.formsavefile').append("<h4 class='savefile-message'>Semothing Went Wrong</h4>");
                            $('.savefile-message').fadeOut("slow");
                        }else{
                            $('.formsavefile').append("<h4 class='savefile-message'>!Issue</h4>");
                            $('.savefile-message').fadeOut("slow");
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    });
</script>
</body>
</html>
