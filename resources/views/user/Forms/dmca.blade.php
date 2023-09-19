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
                    <h2>DMCA Removal Form</h2>
                    <form action="">
                        <div class="form-group">
                            <label for="url">URL of Contested Content:</label>
                            <input type="text" class="form-control" id="url" placeholder="Enter URL Of Contested Content" name="url">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description of Contested Content:</label>
                            <select name="desc" id="desc" class="form-control">
                                <option value="0">Select Option:</option>
                                <option value="video">Video</option>
                                <option value="photo">Photo</option>
                                <option value="song">Original Music or Song</option>
                                <option value="artwork">Artwork</option>
                                <option value="software">Software</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter Your First Name" name="fname">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" id="lname" placeholder="Enter Your Last Name" name="lname">
                        </div>
                        <div class="form-group">
                            <label for="rights">Name Of Copyright Holder:</label>
                            <input type="text" class="form-control" id="rights" placeholder="Enter Name Of Copyright Holder" name="rights">
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
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" placeholder="Enter your Message here" name="message" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You have a good-faith belief that use of the content in question is/was not authorized by the owner,
                                agent, or law.</label>
                        </div>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You acknowledge that you may be subject to liability if you make a material misrepresentation with this
                                form citing that activity is infringing. Fair Use should be taken into consideration.</label>
                        </div>
                        <br>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> The information you have provided on this form is both accurate
                                and truthful.</label>
                        </div>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You understand that the copyright holders name may be placed on disabled content. This will become
                                part of the public record of your request along with a description of the works allegedly infringed. ALL
                                information on this DMCA removal form (including personal information) are a part of the request and
                                may be forwarded to the uploader as a part of a the notice of a DMCA take down request. You understand
                                and agree to all aforementioned items and for your information to be released in this manner.</label>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You understand that this website operates under the DMCA and DOES NOT require prior approval for
                                content to be uploaded. This website does not directly profit from any content not uploaded by a verified
                                user or content partner. This website also in accordance with the DMCA provides the owner a speedy
                                means to have this unauthorized content removed. You understand that this website operates under the
                                DMCA and hereby agree to release the website, its owners, parent company, subsidiaries, and employees
                                from any and all damages to the fullest extent of the law.</label>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-1"><h2>Note: </h2></div>
                            <div class="col-md-9"><h4 style="padding-top: 15px;">Please note that we reserve the right to challenge abuses of the DMCA process, your use of this form
                                    does not waive that right.</h4></div>
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