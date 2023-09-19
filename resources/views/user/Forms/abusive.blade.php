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
                    <h2>Abusive Content Form</h2>
                    <form action="">
                        <div class="form-group">
                            <label for="url">URL of Content:</label>
                            <input type="text" class="form-control" id="url" placeholder="Enter URL Of Contested Content" name="url">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description of Violation:</label>
                            <select name="desc" id="desc" class="form-control">
                                <option value="0">Select Option:</option>
                                <option value="abusive">Abusive Content</option>
                                <option value="illegal">Illegal Content</option>
                                <option value="mycontent">Content Of Me Without My Consent</option>
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
                            <label for="user_name">User Name:</label>
                            <input type="text" class="form-control" id="user_name" placeholder="Enter User Name" name="user_name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="number" class="form-control" id="phone" placeholder="We may need to contact you for further information" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" placeholder="Tell us more about your complaint" name="message" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><h2>Abusive Content: </h2></div>
                            <div class="col-md-9"><h4 style="padding-top: 15px;">If you are reporting abusive content please tell us what the content is and if it ia video
                                    when the abuse occurs.</h4></div>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> All information provided on this form is accurate and truthful.</label>
                        </div>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You understand that misuse or material misrepresentation with this form may result in you being held
                                liable by us and/or the user who uploaded the content, should it be deemed that the upload was not a
                                violation and this form was used maliciously or fraudulently.</label>
                        </div>
                        <br>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You understand that we operate in the safe harbor of the DMCA and do not require content to be
                                authorized or approved by us prior to it being published on our site. If a user uploaded content of you
                                without your permission you understand that we had no prior knowledge and cannot feasibly preview
                                every upload. You understand this and agree to fully release from liability this website, it's owners, parent
                                company, subsidiaries, and employees. This includes any damages personal, property, or
                                socially/characteristically.</label>
                        </div>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You understand that upon submitting this claim the content in question will automatically be set to
                                private or blocked world-wide to stop the distribution of illegal, abusive, or content that otherwise
                                violates our Terms and Conditions. You understand that should this be a good-faith claim that you lose
                                you may be held liable by the uploader of the content.</label>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> You are submitting this form in good-faith that the content in question is illegal, abusive, violates our
                                terms and conditions, or contains you in a circumstance that prior to publishing the uploader would
                                require written consent.</label>
                        </div>
                        <br>
                        <br>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Should for any reason you sue us, despite releasing us from any and all liability, you hereby waive your
                                right to any other form of legal action aside from binding arbitration in small claims court and you agree
                                to go through a court of our choosing.</label>
                        </div>
                        <br>
                        <br>

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

@endsection

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
