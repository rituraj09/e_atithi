<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($guestHouse->pin); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'Config Page'" />
                <div class="card d-flex flex-column border">
                    <div class="bg-success p-1"></div>
                    <form action="{{ route('update-guest-house-config') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="guestHouse_id" value="{{ $guestHouse->id }}">
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-12 mb-2">
                                <h1 class="fw-bold fs-4">Images</h1>
                            </div>
                            
                            {{-- initial image --}}
                            @php
                                $i = 0;
                            @endphp
                            {{-- check thumbnail --}}
                            @foreach ($guestHouseImages as $guestHouseImage)
                                @if ( $guestHouseImage->is_thumb )
                                    <div class="col-md-6 col-lg-3">
                                        <label for="thumb">
                                            <img class="prev-image" src="{{ $guestHouseImage->image }}" id="thumb-view" alt="">    
                                        </label>
                                        <input class="d-none" type="file" name="thumb" id="thumb">
                                    </div>
                                    {{ $i++ }}
                                @endif
                            @endforeach

                            @if ($i === 0)
                                <div class="col-md-6 col-lg-3">
                                    <label for="thumb">
                                        <img class="prev-image" src="{{ asset('assets/images/guest_house_thumb.png') }}" id="thumb-view" alt="">    
                                    </label>
                                    <input class="d-none" type="file" name="thumb" id="thumb">
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endif
                            
                            @if ($guestHouseImages)
                                {{-- other non-thumbnails --}}
                                @foreach ($guestHouseImages as $guestHouseImage)    
                                    @if ( !$guestHouseImage->is_thumb )
                                        <div class="col-md-6 col-lg-3">
                                            <label class="prev-image" for="img{{$i}}">
                                                <img src="{{$guestHouseImage->image}}" id="img{{$i}}-view" alt="">
                                            </label>
                                            <input class="d-none" type="file" name="img{{$i}}" id="img{{$i}}">                                    
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                @endforeach
                            @endif

                            {{-- any empty image --}}
                            @for ( ; $i < 4; $i++)
                                <div class="col-md-6 col-lg-3">
                                    <label class="prev-image" for="img{{$i}}">
                                        <img src="" id="img{{$i}}-view" alt=""><span class="mdi mdi-plus"></span>
                                    </label>
                                    <input class="d-none" type="file" name="img{{$i}}" id="img{{$i}}">
                                </div>
                            @endfor
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Name</div>
                                <input type="text" class="form-control" name="name" value="{{ $guestHouse->name }}" placeholder="Guest house name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Official email</div>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $guestHouse->official_email }}" placeholder="Official email address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Contact number</div>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $guestHouse->contact_no }}" placeholder="Official contact number">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Address</div>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Country</div>
                                <select class="form-control" name="country" id="country">
                                    @foreach ( $countries as $country )
                                        <option value="{{ $country->id }}"
                                        @if ($country->id === $guestHouse->country)
                                            selected
                                        @endif    
                                        >{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">State</div>
                                <select class="form-control" name="state" id="state">
                                    @foreach ( $states as $state )
                                        <option value="{{ $state->id }}"
                                        @if ($state->id === $guestHouse->state)
                                            selected
                                        @endif    
                                        >{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">District</div>
                                <select class="form-control" name="district" id="district">
                                    @foreach ( $districts as $district )
                                        <option value="{{ $district->id }}"
                                        @if ($district->id === $guestHouse->district)
                                            selected
                                        @endif    
                                        >{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">PIN</div>
                                <input name="PIN" class="form-control" id="pin" value="{{ $guestHouse->pin }}" placeholder="PIN code">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Guest type</div>
                                <select name="guest_type" id="" class="form-control text-capitalize">
                                    <option value="1"
                                    @if ($guestHouse->guest_type === 1)
                                        selected
                                    @endif
                                    >Govt employee</option>
                                    <option value="0"
                                    @if ($guestHouse->guest_type === 0)
                                        selected
                                    @endif
                                    >All ( Govt and General public )</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Payment type</div>
                                <select name="payment_type" id="" class="form-control">
                                    <option value="1"
                                    @if ($guestHouse->payment_type === 1)
                                        selected
                                    @endif
                                    >Postpaid</option>
                                    <option value="0"
                                    @if ($guestHouse->payment_type === 0)
                                        selected
                                    @endif
                                    >Prepaid</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">Base price <x-required/> </div>
                                <input type="text" id="price" name="base_price" class="form-control" value="{{ $guestHouse->base_price }}" placeholder="Per room base price" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">CGST Tax <x-required/> </div>
                                <input type="text" name="cgst" class="price form-control" value="{{ $guestHouse->cgst }}" placeholder="CGST Tax in percentage %" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">SGST Tax <x-required/> </div>
                                <input type="text" name="sgst" class="price form-control" value="{{ $guestHouse->sgst }}" placeholder="SGST Tax in percentage %" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">Base price (Govt employee) <x-required/> </div>
                                <input type="text" id="govt_price" name="govt_base_price" class="price form-control" value="{{ $guestHouse->govt_base_price }}" placeholder="Per room base price for govt employee" required>
                            </div>
                        </div>
                        <hr>
                        <div class="text-end mb-3 mx-4">
                            <button class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
                <x-footer/>
            </div>
        </div>
    </div>
<!-- Custom js for this page -->
<script>

    $(document).ready(function() {
        $('#thumb').on('input', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('#thumb-view');
                img.attr('src' , e.target.result);
                if (img.attr('src')) {
                    img.next('.mdi-plus').remove();
                }
            };   
            reader.readAsDataURL(file);
        });
        $('#img1').on('input', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('#img1-view');
                img.attr('src' , e.target.result);
                if (img.attr('src')) {
                    img.next('.mdi-plus').remove();
                }
            };   
            reader.readAsDataURL(file);
        });
        $('#img2').on('input', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('#img2-view');
                img.attr('src' , e.target.result);
                if (img.attr('src')) {
                    img.next('.mdi-plus').remove();
                }
            };   
            reader.readAsDataURL(file);
        });
        $('#img3').on('input', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('#img3-view');
                img.attr('src' , e.target.result);
                if (img.attr('src')) {
                    img.next('.mdi-plus').remove();
                }
            };   
            reader.readAsDataURL(file);
        });
        // $('input[type="file"]').change(function(e) {
        //   $('#img1').on('input', function(e) {
        //     var output = document.getElementById('preview');

        //     for (var i = 0; i < files.length; i++) {
        //         if (i===4) {
        //             alert("Limit");
        //             console.log('alert')
        //         } else {
        //             var file = files[i];
        //             var reader = new FileReader();

        //             reader.onload = function(e) {
        //                 var img = document.createElement('img');
        //                 img.src = e.target.result;
        //                 img.classList.add('col-4');
        //                 img.classList.add('p-3');
        //                 img.classList.add('rounded-2');
        //                 img.classList.add('border');
        //                 output.appendChild(img);
        //                 var removeButton = document.createElement('button');
        //                 removeButton.classList.add('btn');
        //                 removeButton.classList.add('btn-danger');
        //                 removeButton.classList.add('overlap-button');
        //                 removeButton.innerHTML = 'Remove';
        //                 removeButton.addEventListener('click', function() {
        //                     output.removeChild(img);
        //                     output.removeChild(removeButton);
                            
        //                     // Remove the corresponding file from the files array
        //                     var index = Array.from(output.children).indexOf(img);
        //                     files.splice(index, 1);
        //                 });
        //                 output.appendChild(img);
        //                 output.appendChild(removeButton);
        //             };            
        //         }

        //         reader.readAsDataURL(file);
        //     }
        // });
    });

    </script>

<x-main-footer/>
