@extends( 'layouts.user' )


@section( 'styles' )

    <link rel="stylesheet" type="text/css" href="{{asset('streamtube/css/custom-style.css')}}">


@endsection

@section('content')

    <div class="y-content">
        <div class="row content-row">
            @include('layouts.user.nav')
            <div class="page-inner col-sm-9 col-md-10">
                @include('notification.notify')
                <div class="container">
                    <h2>Verification Form</h2>
                    <form action="">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter Your First Name" name="fname">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" id="lname" placeholder="Enter Your Last Name" name="lname">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date Of Birth:</label>
                            <input type="text" class="form-control" id="dob" placeholder="Enter Your Date Of Birth" name="dob">
                        </div>
                        <div class="form-group">
                            <label for="age">Current Age:</label>
                            <input type="text" class="form-control" id="age" placeholder="Enter Your Current Age" name="age">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sex:</label>
                            <select name="sex" id="sex" class="form-control">
                                <option value="0">Select Option:</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter your city" name="city">
                        </div>
                        <div class="form-group">
                            <label for="region">Region:</label>
                            <input type="text" class="form-control" id="state" placeholder="Enter your Region" name="region">
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <input type="text" class="form-control" id="country" placeholder="Enter Country" name="country">
                        </div>
                        <div class="form-group">
                            <label for="code">Postal/Zip Code:</label>
                            <input type="text" class="form-control" id="code" placeholder="Enter Postal/Zip Code" name="code">
                        </div>
                        <div class="form-group">
                            <label for="user_name">User Name:</label>
                            <input type="text" class="form-control" id="user_name" placeholder="Enter User Name" name="user_name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="number" class="form-control" id="phone" placeholder="Enter phone number" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-1"><h2>Note: </h2></div>
                            <div class="col-md-9"><h4 style="padding-top: 15px;">"Proof of Identity*"<br>
                                    "In order to be verified you must upload the following: <br>
                                    &nbsp1. A photo of your current drivers license, state ID, or passport.<br>
                                    &nbsp2. A photo of yourself (face clearly visible) holding a piece of paper with your username and the date
                                    &nbsp written clearly.<br>
                                    &nbsp3. A photo or copy of a current utility bill.
                                    &nbsp We realize that this may be a bit inconvenient but we must verify your identity to verify in good
                                    conscience."</h4></div>
                        </div>
                        <br>

{{--                        <div class="form-group">--}}
                            <label for="attachments">Attach Document: &nbsp</label>
                            <input type="file" id="attachments" name="attachments">
{{--                        </div>--}}

                        <br>

                        <div class="checkbox">
                            <label><input type="checkbox" name="remember">I hereby attest that all information on this form is accurate and truthful
                                agent, or law.</label>
                        </div>
                        <br>

                        <br>

                        <div class="form-group">
                            <label for="signature">Signature: </label>&nbsp
                            <canvas style="border: 1px solid black" id="signature" width="300" height="100"></canvas>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="signature" />
                        </div>
                        <div class="form-group">
                            <label for="birthday">Date:</label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            <input type="date" id="birthday" name="birthday">
                        </div>
                        <div class="g-recaptcha" id="rcaptcha"  data-sitekey="site key"></div>
                        <span id="captcha" style="color:white" /></span>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <script>
        var canvas = document.getElementById('signature');
        var ctx = canvas.getContext("2d");
        var drawing = false;
        var prevX, prevY;
        var currX, currY;
        var signature = document.getElementsByName('signature')[0];

        canvas.addEventListener("mousemove", draw);
        canvas.addEventListener("mouseup", stop);
        canvas.addEventListener("mousedown", start);

        function start() {
            drawing = true;
        }

        function stop() {
            drawing = false;
            prevX = prevY = null;
            signature.value = canvas.toDataURL();
        }

        function draw(e) {
            if (!drawing) {
                return;
            }
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            if (!prevX && !prevY) {
                prevX = currX;
                prevY = currY;
            }

            ctx.beginPath();
            ctx.moveTo(prevX, prevY);
            ctx.lineTo(currX, currY);
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 2;
            ctx.stroke();
            ctx.closePath();

            prevX = currX;
            prevY = currY;
        }

    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>

        function get_action(form)
        {
            var v = grecaptcha.getResponse();
            if(v.length == 0)
            {
                document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
                return false;
            }
            else
            {
                document.getElementById('captcha').innerHTML="Captcha completed";
                return true;
            }
        }

    </script>
@endsection