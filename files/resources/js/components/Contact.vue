<template>
    <!-- ***** Contact Us Area Start ***** -->
    <section
        class="footer-contact-area section_padding_100 clearfix"
        id="contact"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2>Get in touch with us!</h2>
                        <div class="line-shape"></div>
                    </div>
                    <div class="footer-text">
                        <p>We'll get back to you immediately</p>
                    </div>
                    <div class="address-text">
                        <p><span>Address:</span> Kubwa, Abuja</p>
                        <p><span>Address:</span> GRA, Enugu</p>
                        <p><span>Address:</span> Ikeja, Lagos</p>
                    </div>
                    <div class="phone-text">
                        <p>
                            <span>Phone:</span> +234-703-977-52-98,
                            +234-806-297-70-23, +234-806-693-77-99
                        </p>
                    </div>
                    <div class="email-text">
                        <p><span>Email:</span> info@zizix6.com</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Form Start-->
                    <div class="contact_from">
                        <!-- @if(request()->session()->exists('success'))
                          <p class="alert-success">{{session('success')}} </p>
                        @endif
                        @if(request()->session()->exists('error'))
                          <p class="alert-danger">{{session('error')}} </p>
                        @endif -->

                        @include('inc.errors')

                        <!-- {!! Form::open(['action' => ['ContactController@save'], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!} -->
                        <form method="post" enctype="multipart/form-data">
                            <!-- Message Input Area Start -->
                            <div class="contact_input_area">
                                <div class="row">
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                id="name"
                                                placeholder="Your Name"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control"
                                                name="email"
                                                id="email"
                                                placeholder="Your E-mail"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="phone"
                                                id="phone"
                                                placeholder="Phone Number"
                                            />
                                        </div>
                                    </div>

                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="title"
                                                id="title"
                                                placeholder="Title of Message"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <span style="color: red">*</span>
                                            <textarea
                                                name="message"
                                                class="form-control"
                                                id="message"
                                                cols="30"
                                                rows="4"
                                                placeholder="Your Message"
                                                required
                                            ></textarea>
                                        </div>
                                    </div>

                                    <div
                                        class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}"
                                    >
                                        <label class="col-md-4 control-label"
                                            >Captcha</label
                                        >

                                        <!-- <div class="captcha">
                                           
                                           <button type="button" id="captcha-refresh" class="btn btn-success">
                                                <i class="fa fa-refresh"></i>
                                           </button>
                                           <input type="text" class="form-control" name="captcha" id="contact-captcha" placeholder="Enter captcha code" required value="{!! old('captcha') !!}">
                                        </div>
                                       
                                        <div class="g-recaptcha" data-sitekey="6Le7AbUUAAAAAJT12tjvg_x2gmb9bjUJvJczfmTk"></div> -->
                                    </div>

                                    <!-- Single Input Area Start -->
                                    <div class="col-12">
                                        <button
                                            type="submit"
                                            class="btn submit-btn"
                                        >
                                            Send Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Message Input Area End -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area End ***** -->
</template>

<script setup></script>

<style scoped></style>
