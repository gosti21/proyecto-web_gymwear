<div>
    <section class="rounded-lg bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-3">
            <h1 class="text-lg font-semibold text-gray-700">
                Opciones
            </h1>
        </header>

        <div class="p-6">

            <div class="space-y-6">

                @foreach ($options as $option)

                    <div class="p-6 rounded-lg border border-gray-200 relative">

                        <div class="absolute -top-3 bg-white">

                        </div>


                    </div>
                @endforeach

            </div>


        </div>

    </section>

</div>
