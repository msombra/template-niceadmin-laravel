<x-partials.app>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            {{-- Img Logo --}}
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div>

                            {{-- Form Register --}}
                            <div class="card mb-3">
                                <div class="card-body">
                                    {{ $slot }}
                                </div>
                            </div>

                            <div class="credits">
                                Desenvolvido por <a href="#">NIT</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

            @include('includes.toasts')

        </div>
    </main>

</x-partials.app>
