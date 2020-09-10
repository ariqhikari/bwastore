@extends('layouts.dashboard')

@section('title', 'Store Dashboard Account Settings')

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                My Account
            </h2>
            <p class="dashboard-subtitle">
                Update your current profile
            </p>
        </div>
        <div class="dashboard-content" id="locations">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('status'))
                        <div class="alert alert-success">{{ Session::get('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('dashboard.settings.update', 'dashboard.settings.account') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="address_one">Address 1</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="address_one"
                                            name="address_one"
                                            value="{{ Auth::user()->address_one }}"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="address_two">Address 2</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="address_two"
                                            name="address_two"
                                            value="{{ Auth::user()->address_two }}"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="province_id">Province</label>
                                            <select name="province_id" id="province_id" class="form-control" v-if="provinces" v-model="province_id">
                                                <option disabled>Select Province</option>
                                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regency_id">City</label>
                                            <select name="regency_id" id="regency_id" class="form-control" v-if="regencies" v-model="regency_id">
                                                <option disabled>Select Regency</option>
                                                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="zip_code">Postal Code</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="zip_code"
                                            name="zip_code"
                                            value="{{ Auth::user()->zip_code }}"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="country">Country</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="country"
                                            name="country"
                                            value="{{ Auth::user()->country }}"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="phone_number">Mobile</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="phone_number"
                                            name="phone_number"
                                            value="{{ Auth::user()->phone_number }}"
                                        />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button
                                        type="submit"
                                        class="btn btn-success px-5"
                                        >
                                        Save Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var gallery = new Vue({
        el: "#locations",
        mounted() {
            AOS.init();
            this.getProvincesData();
        },
        data: {
            provinces: null,
            regencies: null,
            province_id: null,
            regency_id: null,
        },
        methods: {
            getProvincesData(){
                var self = this;
                axios.get('{{ route("api-provinces") }}')
                    .then(function (response) {
                        self.provinces = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            getRegenciesData(){
                var self = this;
                axios.get('{{ url("api/regencies") }}/' + self.province_id)
                    .then(function (response) {
                        self.regencies = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
        },
        watch: {
            province_id: function(val, oldVal){
                this.regency_id = null;
                this.getRegenciesData();
            }
        }
    });
</script>
@endpush