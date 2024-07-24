
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" type="text/css" href="donation.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<div class="container">

    <form action="paymail.php" mode="POST">

        <div class="row">

            <div class="col">

                <h2 class="title">BILLING ADDRESS</h2>

                <div class="inputBox">
                    
                Full Name: <input type="text" placeholder="name" id="fullname" required>
                </div>
                <div class="inputBox">
                   Email: <input type="email"  placeholder="example@example.com" id="email" required>
                </div>
                <div class="inputBox">
                    
                    Address:<input type="text"  placeholder="room - street - locality" id="address" required>
                </div>
                <div class="inputBox">
                    
                    City:<input type="text" placeholder="city" id="city" required>
                </div>

                <div class="inputbox">
                    <div class="inputBox">
                       
                       Zipcode: <input type="number" placeholder="Zipcode" id="zipcode" required>
                    </div>

                </div>

            </div>

            <div class="col">

                <h3 class="title"> PAYMENT </h3>

                <div class="inputBox">
                   Amount: <input type="number"  placeholder=" amount" id="amount" required>
                    
                </div>
               
                <div class="inputBox">
                    individual: <input type="text" placeholder="type" id="individual" required>
                </div>
                <div class="inputBox">
                   
                    Phone number :<input type="text"  placeholder="XXXXX-XXXXX" id="phone" required>
                </div>
                <div class="inputBox">
                   
                    Mode of payment :<input type="text" placeholder="UPI or DEBIT/CREDIT or NET BANKING" id="mode" required>
                </div>
                <div class="inputBox">
                   
                    Country:<input type="text"  placeholder="country" id="country" required>
                </div>
                
       

            </div>
    
        </div>

        <input type="button" value= " proceed to pay"  name="pay" class="submit-btn"  onclick="makepayment()" >

    </form>
</div>    
<script>
    function makepayment()
    {
        var full_name = $("#fullname").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var zipcode = $("#zipcode").val();
        var amount = $("#amount").val();
        var individual = $("#individual").val();
        var phone = $("#phone").val();
        var mode = $("#mode").val();
        var country = $("#country").val();
        var options = {
        "key": "rzp_test_8AdITko7KmTwN7", // Enter the Key ID generated from the Dashboard
        "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise.
        "currency": "INR",
        "name": "ENDEAVOURS FOUNDATION",
        "description": "Test Transaction",
        "image": "https://example.com/your_logo",
        //"account_id": "acc_Ef7ArAsdU5t0XL",
        //"order_id": "order_DBJOWzybf0sJbb", //This is a sample Order id. Pass the `id` obtained in the response of Step 1.
     "handler": function (response){
       
       jQuery.ajax({
         method:"POST",
         url:"donate.php",
         data:{    
                    fullname: full_name,
                    email: email,
                    address: address,
                    city: city,
                    zipcode:zipcode,
                    amount: amount,
                    individual: individual,
                    phone: phone,
                    mode: mode,
                    country: country,
                 },
                    success:function(result){
                    window.location.href="donate.php";}
                     })
                    $.ajax({
                     method: "POST",
                     url: "paymail.php",
                     data: { email:email, 
                             name: full_name,
                            },
                     success:function(result){
                      window.location.href="paymail.php";}
                     /*success: function(response) {
                         console.log("paymail.php request succeeded:", response);
                     },
                     error: function(xhr, status, error) {
                         console.error("paymail.php request failed:", status, error);
                     }*/
                    })
     },
     "prefill": {
        "name": full_name,
        "email": email,
        "contact": phone
     },
     "notes": {
        "address": "Razorpay Corporate Office"
     },
     "theme": {
        "color": "#3399cc"
     }
    };
    var rzp1 = new Razorpay(options);
     rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
    });
    rzp1.open();
   
    }

</script>


</body>
</html>