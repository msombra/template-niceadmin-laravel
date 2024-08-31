<x-master>
    <main id="main" class="main flex-grow-1">

        <div class="pagetitle">
            <h1>{{ $pagetitle }}</h1>
        </div>

        <section class="section dashboard">

            <div class="row">
                <div class="col-{{ $col ?? 12 }} mx-auto">

                    <div class="card">
                        <div class="card-body p-4">

                            {{ $slot }}

                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>
</x-master>
