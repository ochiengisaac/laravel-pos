@extends('layouts.admin')

@section('title', 'Update Supplier')
@section('content-header', 'Update Supplier')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('suppliers.update', $supplier) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="business_name">Business Name</label>
                    <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror"
                           id="business_name"
                           placeholder="Business Name" value="{{ old('business_name', $supplier->business_name) }}">
                    @error('business_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name"
                           placeholder="First Name" value="{{ old('first_name', $supplier->first_name) }}">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name"
                           placeholder="Last Name" value="{{ old('last_name', $supplier->last_name) }}">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                           placeholder="Email" value="{{ old('email', $supplier->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                           placeholder="Phone" value="{{ old('phone', $supplier->phone) }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                           id="address"
                           placeholder="Address" value="{{ old('address', $supplier->address) }}">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="avatar">Logo/Avatar</label><br/><br/>
                    <?php if($supplier->avatar):?>
                    <img src="{{$supplier->getAvatarUrl()}}" width="20%" /><br/><br/>

                    <?php endif; ?>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar" id="avatar">
                        <label class="custom-file-label" for="avatar">Choose file</label>
                    </div>
                    @error('avatar')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="header_image">Header Image</label><br/><br/>
                    <?php if($supplier->header_image):?>
                    <img src="{{$supplier->getHeaderImageUrl()}}" width="70%" height="20%"/><br/><br/>

                    <?php endif; ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="header_image" id="header_image">
                        <label class="custom-file-label" for="header_image">Choose file</label>
                    </div>
                    @error('header_image')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tagline">Business Tagline</label>
                    <input type="text" name="tagline" class="form-control @error('tagline') is-invalid @enderror" id="tagline"
                           placeholder="tagline" value="{{ old('tagline', $supplier->tagline) }}">
                    @error('tagline')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="longitude">Long</label>
                    <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                           placeholder="longitude" value="{{ old('longitude', $supplier->longitude) }}">
                    @error('longitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="latitude">Lat</label>
                    <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                           placeholder="latitude" value="{{ old('latitude', $supplier->latitude) }}">
                    @error('latitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <hr/>

                <div class="form-group">
                    <label for="national_identification_no">National Identification Number</label>
                    <input type="text" name="national_identification_no" class="form-control @error('national_identification_no') is-invalid @enderror" id="national_identification_no"
                           placeholder="national_identification_no" value="{{ old('national_identification_no', $supplier->national_identification_no) }}">
                    @error('national_identification_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="passport_number">Passport Number</label>
                    <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" id="passport_number"
                           placeholder="passport_number" value="{{ old('passport_number', $supplier->passport_number) }}">
                    @error('passport_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="business_registration_no">Business Registration Number</label>
                    <input type="text" name="business_registration_no" class="form-control @error('business_registration_no') is-invalid @enderror" id="business_registration_no"
                           placeholder="business_registration_no" value="{{ old('business_registration_no', $supplier->business_registration_no) }}">
                    @error('business_registration_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="national_identification_front">National Id Front Side Landscape Picture (JPEG/PNG)</label><br/><br/>
                    <?php if($supplier->national_identification_front):?>
                    <img src="{{$supplier->getNationalIdentificationPicFrontUrl()}}" width="70%" height="20%"/><br/><br/>

                    <?php endif; ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="national_identification_front" id="national_identification_front">
                        <label class="custom-file-label" for="national_identification_front">Choose file</label>
                    </div>
                    @error('national_identification_front')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="national_identification_back">National Id Back Side Landscape Picture (JPEG/PNG)</label><br/><br/>
                    <?php if($supplier->national_identification_back):?>
                    <img src="{{$supplier->getNationalIdentificationPicBackUrl()}}" width="70%" height="20%"/><br/><br/>

                    <?php endif; ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="national_identification_back" id="national_identification_back">
                        <label class="custom-file-label" for="national_identification_back">Choose file</label>
                    </div>
                    @error('national_identification_back')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="business_registration_cert">Business Registration Certificate (JPEG/PNG)</label><br/><br/>
                    <?php if($supplier->business_registration_cert):?>
                    <img src="{{$supplier->getBusinessRegistrationCertUrl()}}" width="70%" height="20%"/><br/><br/>

                    <?php endif; ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="business_registration_cert" id="business_registration_cert">
                        <label class="custom-file-label" for="business_registration_cert">Choose file</label>
                    </div>
                    @error('business_registration_cert')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="recent_bank_statement">Recent Bank Statement (JPEG/PNG)</label><br/><br/>
                    <?php if($supplier->business_registration_cert):?>
                    <img src="{{$supplier->getRecentBankStatmtUrl()}}" width="70%" height="20%"/><br/><br/>

                    <?php endif; ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="recent_bank_statement" id="recent_bank_statement">
                        <label class="custom-file-label" for="recent_bank_statement">Choose file</label>
                    </div>
                    @error('recent_bank_statement')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kyc_completed">KYC Completed <span style="color:red">(If checked, user will transact using this application)</span></label>

                    <div class="col-md-6" style="padding-left:0px" >                                
                            <select name="kyc_completed" class="form-control @error('kyc_completed') is-invalid @enderror" id="kyc_completed">
                                <option selected value="">Select KYC Status</option>
                                <option value="0" @if ($supplier->kyc_completed == "0") {{ 'selected' }} @endif>No</option>
                                <option value="1" @if ($supplier->kyc_completed == "1") {{ 'selected' }} @endif>Yes</option>
                            </select>
                        @error('kyc_completed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
