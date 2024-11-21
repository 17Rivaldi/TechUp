@extends('web.layouts.master')

@php
    $showNavbar = false;
    $showFooter = false;
@endphp

@section('content')
    <section class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-md-7 d-flex flex-column justify-content-center">
                <div class="text-center mb-4">
                    <h1>Privasi dan Kebijakan</h1>
                </div>

                <div class="accordion shadow rounded" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Kepemilikan Plaform dan Konten
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Seluruh konten, termasuk namun tidak terbatas pada teks, gambar, logo, dan desain yang
                                terdapat pada platform ini adalah milik TechUp atau pihak yang bekerja sama dengan kami.
                                Segala hak cipta, hak kekayaan intelektual, dan hak terkait dilindungi oleh hukum yang
                                berlaku. Dilarang menyalin, mengubah, atau mendistribusikan konten tanpa izin tertulis dari
                                TechUp.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Penggunaan Platform dan Konten
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Anda diperbolehkan menggunakan platform ini hanya untuk tujuan yang sesuai dengan hukum.
                                Setiap penggunaan konten atau fitur platform untuk kegiatan yang melanggar hukum,
                                menyesatkan, atau merugikan pihak lain dilarang. Kami berhak menghentikan akses Anda jika
                                ditemukan pelanggaran terhadap ketentuan ini.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Batasan dan Tanggung Jawab
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Kami berupaya menyediakan informasi yang akurat dan terkini, tetapi tidak menjamin bahwa
                                semua informasi di platform ini sepenuhnya bebas dari kesalahan atau kekeliruan. Kami tidak
                                bertanggung jawab atas keruhian langsung maupun tidak langsung yang timbul akibat penggunaan
                                platform ini. Pengguna bertanggung jawab penuh atas keputusan yang diambil berdasarkan
                                informasi yang tersedia.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Merek Dagang dan Logo
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Semua merek dagang, logo, dan nama dagang yang digunakan pada platform ini adalah milik kami
                                atau mitra kami. Penggunaan tanpa izin untuk tujuan komersial dilarang
                                dan dapat dikenakan sanksi hukum.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Hubungi Kami
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Jika Anda memiliki pertanyaan, keluhan, atau memerlukan klarifikasi mengenai ketentuan ini,
                                Anda dapat menghubungi kami melalui:
                                <ul>
                                    <li>Email : techup@testemail.id</li>
                                    <li>Telepon : +62 898981118</li>
                                    <li>Alamat : Jl.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <img src="{{ asset('assets/terms.jpg') }}" alt="Terms Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
@endsection
