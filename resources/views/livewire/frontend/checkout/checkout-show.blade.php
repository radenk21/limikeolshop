{{-- <div class="container mt-5">
    <h4>Checkout</h4>
    <hr>
    @if (session('danger-alert'))
        <div class="alert alert-danger">
            {{ session('danger-alert') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ( $totalHarga != 0 )
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        Item Total Amount :
                        <span class="float-end">Rp {{ number_format($totalHarga, 0, '.', '.') }}</span>
                    </h4>
                    <hr>
                    <small>* Items will be delivered in 3 - 5 days.</small>
                    <br/>
                    <small>* Tax and other charges are included ?</small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        Basic Information
                    </h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Full Name</label>
                            <input type="text" wire:model.defer="fullname" class="form-control" placeholder="Enter Full Name" />
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone Number</label>
                            <input type="number" wire:model.defer="phone" class="form-control" placeholder="Enter Phone Number" />
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email Address</label>
                            <input type="email" wire:model.defer="email" class="form-control" placeholder="Enter Email Address" />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pin-code (Zip-code)</label>
                            <input type="number" wire:model.defer="pincode" class="form-control" placeholder="Enter Pin-code" />
                            @error('pincode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Full Address</label>
                            <textarea wire:model.defer="address" class="form-control" rows="2"></textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Select Payment Mode: </label>
                            <div class="d-md-flex align-items-start">
                                <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                    <button class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                </div>
                                <div class="tab-content col-md-9" id="v-pills-tabContent">
                                    <div class="tab-pane fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                        <h6>Cash on Delivery Mode</h6>
                                        <hr/>
                                        <button type="button" wire:click="codOrder" class="btn btn-primary">
                                            <span wire:loading.remove>
                                                Pesan Sekarang (Cash on Delivery)
                                            </span>
                                            <span wire:loading wire:target="codOrder">
                                                Menempatkan Pesan
                                            </span>
                                        </button>

                                    </div>
                                    <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                        <h6>Online Payment Mode</h6>
                                        <hr/>
                                        <h6>Silahkan Bayar melalui :</h6>
                                        <div>
                                            <p>Dana : 0895464657864</p>
                                            <p>BCA : 2323814</p>
                                            <p>BNI : 2323814</p>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" wire:model.defer="selectedPaymentMethod" name="selectedPaymentMethod" value="Bayar Melalui Dana" id="dana-radio">
                                            <label class="form-check-label" for="dana-radio">
                                                Bayar melalui Dana
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" wire:model.defer="selectedPaymentMethod" name="selectedPaymentMethod" value="Bayar Melalui BCA" id="bca-radio">
                                            <label class="form-check-label" for="bca-radio">
                                                Bayar melalui BCA
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" wire:model.defer="selectedPaymentMethod" name="selectedPaymentMethod" value="Bayar Melalui BNI" id="bni-radio">
                                            <label class="form-check-label" for="bni-radio">
                                                Bayar melalui BNI
                                            </label>
                                        </div>
                                        <label>Masukkan nomor rekening pembayaran</label>
                                        <div>
                                            <input type="text" wire:model.defer="no_rekening" class="form-control" placeholder="Masukkan nomor rekening" />
                                            @error('no_rekening')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="button" wire:click="onlineOrder" class="btn btn-warning mt-3">
                                            Pesan Sekarang (Online Payment)
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    @else
        <div class="card card-body shadow text-center p-md-5">
            <h4>Tidak ada keranjang untuk di checkout</h4>
            <a href="{{ url('/collections') }}" class="btn btn-warning">Belanja Sekarang</a>
        </div>
    @endif
</div> --}}

<div class="container">
    <div class="checkout">
        <h1> Checkout </h1>
        @if (session('danger-alert'))
            <div class="alert alert-danger">
                {{ session('danger-alert') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="checkout-content">
            <div class="information-checkout">
                <div class="informasi-penerima">
                    <h2>Informasi Penerima</h2>
                        <div class="input-informasi">
                            <label for="namalengkap-penerima">Nama Lengkap</label>
                            <input type="text" id="namalengkap-penerima"  wire:model.defer="fullname" placeholder="Masukkan nama lengkap penerima">
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label for="email">Email</label>
                            <input type="email" id="email" wire:model.defer="email" placeholder="Masukkan email penerima">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label for="noTelp">No Telepon</label>
                            <input type="number" id="noTelp" wire:model.defer="phone" placeholder="Masukkan nomor telepon anda">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label for="kodePos">Kode pos (Zip-code)</label>
                            <input type="number" id="kodePos" wire:model.defer="pincode"placeholder="Enter Pin-code" />
                            @error('pincode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" class="rounded p-2" wire:model.defer="address" rows="2" placeholder="Masukkan alamat anda"></textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                </div>
                <div class="pengirim">
                    <h2>Pengirim</h2>
                    <div class="shipping-method">
                        <table>
                            <tr>
                                <td class="nama-pembayaran">
                                    <input type="radio" name="nama-pengirim" id="nama-pengirim">
                                    <label for="nama-pembayaran"> JNE </label>
                                </td>
                                <td>
                                    <div class="kartu-pembayaran">
                                        <span>Free </span>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    

                </div>
            </div>
            <div class="your-cart">
                <h2> Keranjang anda</h2>
                <div class="order-detail">
                    <div class="subtotal-detail">
                        <p> Subtotal </p>
                        <p> Pengiriman </p>
                        <span>Total</span>
                    </div>
                    <div class="qty-detail">
                        <p> Rp 1.000.000 </p>
                        <p> Rp 25.000 </p>
                        <span> Rp {{ number_format($totalHarga, 0, '.', '.') }}</span>
                    </div>
                </div>
                <label>Select Payment Mode: </label>
                <div class="d-md-flex align-items-start">
                    <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                        <button class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                    </div>
                    <div class="tab-content col-md-9" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                            <h6>Cash on Delivery Mode</h6>
                            <hr/>
                            <button type="button" wire:click="codOrder" class="btn btn-primary">
                                <span wire:loading.remove>
                                    Pesan Sekarang (Cash on Delivery)
                                </span>
                                <span wire:loading wire:target="codOrder">
                                    Menempatkan Pesan
                                </span>
                            </button>

                        </div>
                        <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                            <h6>Online Payment Mode</h6>
                            <hr/>
                            <h6>Silahkan Bayar melalui :</h6>
                            <div>
                                <p>Dana : 0895464657864</p>
                                <p>BCA : 2323814</p>
                                <p>BNI : 2323814</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model.defer="selectedPaymentMethod" name="selectedPaymentMethod" value="Bayar Melalui Dana" id="dana-radio">
                                <label class="form-check-label" for="dana-radio">
                                    Bayar melalui Dana
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model.defer="selectedPaymentMethod" name="selectedPaymentMethod" value="Bayar Melalui BCA" id="bca-radio">
                                <label class="form-check-label" for="bca-radio">
                                    Bayar melalui BCA
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model.defer="selectedPaymentMethod" name="selectedPaymentMethod" value="Bayar Melalui BNI" id="bni-radio">
                                <label class="form-check-label" for="bni-radio">
                                    Bayar melalui BNI
                                </label>
                            </div>
                            <label>Masukkan nomor rekening pembayaran</label>
                            <div>
                                <input type="text" wire:model.defer="no_rekening" class="form-control" placeholder="Masukkan nomor rekening" />
                                @error('no_rekening')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="button" wire:click="onlineOrder" class="btn btn-warning mt-3">
                                Pesan Sekarang (Online Payment)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>