<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nakimuli Foundation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style type="text/css">
        body {
            background-color: purple;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(isset($_GET['pay'])): ?>

            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <a href="index.html" class="d-flex justify-content-center">
                        <img src="images/naki.png" 
                        alt="Nakimuli | Foundation"
                        style="width: 225px; height: 160px">
                    
                    </a>
                    <div class="card card-body shadow" id="smart-button-container">
                        <form action="#" class="appointment">
                            <h4 class="mb-4 appointment-head">Giving is the greatest act of Kindness</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject">Select Cause</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                <select id="formSelect" title ="fa" name ="form"class="form-control">
                                                    <option >Food</option>
                                                    <option >Medical Health</option>
                                                    <option >Education</option>
                                                    <option >Vulnerables</option>
                                                    <option >Tourism enhancement</option>
                                                    <option >Financial Inclusion</option>
                                                    <option >Environmental Sustainability</option>
                                                    <option >Community Health and sanitation</option>
                                                    <option >Women Empowerment Programmes</option>
                                                    <option >Youth Transformation Programmes</option>
                                                    <option >Other</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($_GET['pay'] == 'mobile'): ?>
                                    <a href="./donate.php?pay=paypal" class="btn btn-info w-100" disabled>
                                        This Payment option is still in developement. Donate with PayPal?
                                    </a>
                                
                                <?php endif ?>
                            </div>
                        </form>
                        <?php if($_GET['pay'] == 'paypal'): ?>
                            <hr/>
                            <div class="d-flex justify-content-even"><label for="description" class="w-25">Full Name </label><input type="text" name="descriptionInput" id="description" maxlength="127" value="" class="form-control w-75"></div>
                            <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter your full name</p>

                            <div class="d-flex justify-content-even"><label for="amount" class="w-25">Amount ( <span> USD</span>) </label><input name="amountInput" type="number" id="amount" value="" class="form-control w-75"></div>
                            <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter amount to donate</p>

                            <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
                            <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>

                                <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
                            <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
                            <script>
                                function initPayPalButton() {
                                    var description = document.querySelector('#smart-button-container #description');
                                    var amount = document.querySelector('#smart-button-container #amount');
                                    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
                                    var priceError = document.querySelector('#smart-button-container #priceLabelError');
                                    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
                                    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
                                    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

                                    var elArr = [description, amount];

                                    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
                                    invoiceidDiv.style.display = "block";
                                    }

                                    var purchase_units = [];
                                    purchase_units[0] = {};
                                    purchase_units[0].amount = {};

                                    function validate(event) {
                                    return event.value.length > 0;
                                    }

                                    paypal.Buttons({
                                    style: {
                                        color: 'gold',
                                        shape: 'rect',
                                        label: 'paypal',
                                        layout: 'vertical',
                                        
                                    },

                                    onInit: function (data, actions) {
                                        actions.disable();

                                        if(invoiceidDiv.style.display === "block") {
                                        elArr.push(invoiceid);
                                        }

                                        elArr.forEach(function (item) {
                                        item.addEventListener('keyup', function (event) {
                                            var result = elArr.every(validate);
                                            if (result) {
                                            actions.enable();
                                            } else {
                                            actions.disable();
                                            }
                                        });
                                        });
                                    },

                                    onClick: function () {
                                        if (description.value.length < 1) {
                                        descriptionError.style.visibility = "visible";
                                        } else {
                                        descriptionError.style.visibility = "hidden";
                                        }

                                        if (amount.value.length < 1) {
                                        priceError.style.visibility = "visible";
                                        } else {
                                        priceError.style.visibility = "hidden";
                                        }

                                        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
                                        invoiceidError.style.visibility = "visible";
                                        } else {
                                        invoiceidError.style.visibility = "hidden";
                                        }

                                        purchase_units[0].description = description.value;
                                        purchase_units[0].amount.value = amount.value;

                                        if(invoiceid.value !== '') {
                                        purchase_units[0].invoice_id = invoiceid.value;
                                        }
                                    },

                                    createOrder: function (data, actions) {
                                        return actions.order.create({
                                        purchase_units: purchase_units,
                                        });
                                    },

                                    onApprove: function (data, actions) {
                                        return actions.order.capture().then(function (orderData) {

                                        // Full available details
                                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                                        // Show a success message within this page, e.g.
                                        const element = document.getElementById('paypal-button-container');
                                        element.innerHTML = '';
                                        element.innerHTML = '<h3>Thank you for your Donation!</h3>';

                                        // Or go to another URL:  actions.redirect('thank_you.html');
                                        
                                        });
                                    },

                                    onError: function (err) {
                                        console.log(err);
                                    }
                                    }).render('#paypal-button-container');
                                }
                                initPayPalButton();
                            </script>
                    </div>
                </div>
            <?php endif ?>

        <?php else:?>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-info mt-5">
                        Oops, you forgot to choose the payment option. <br/>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="./donate.php?pay=paypal" class="btn btn-warning">
                                Donate with PayPal?
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="./donate.php?pay=flutter" class="btn btn-warning">
                                Donate with Flutterwave?
                            </a>
                        </div>
                    </div>
            </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>