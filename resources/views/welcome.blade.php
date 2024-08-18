<x-master>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="content_area">
        <style>
            .page-wrapper {
                padding-left: 0px;
                padding-right: 0px;
            }
        </style>
        <div class="row">
            <div class="col-md-6"><p class=""style="padding: 1rem;background: floralwhite;border-radius: 1rem;box-shadow: 0px 0px 2px 0px;text-align:center; width:92%;">Total Email Ticket</p>
                <div class="row row-cols-1 row-cols-md-2" style="background: lightsteelblue;padding: 2rem;width: 96%;border-radius: 1rem;">
                     <x-widgets.counter-component
                        gradient="scooter" name="Open Ticket" count="8" border="border-info" countClass="text-info"
                        icon="bi bi-cart" />
                    <x-widgets.counter-component gradient="bloody" name="Working Ticket" count="99"
                        border="border-danger" countClass="text-danger" icon="bi bi-people-fill" />
                    <x-widgets.counter-component gradient="ohhappiness" name="Pending Ticket" count="500"
                        border="border-success" countClass="text-success" icon="bi bi-wallet" />
                    <x-widgets.counter-component gradient="blooker" name="Solved Ticket" count="20"
                        border="border-warning" countClass="text-warning" icon="bi bi-collection" />
                </div>
            </div>

            <div class="col-md-6"><p class=""style="padding: 1rem;background: floralwhite;border-radius: 1rem;box-shadow: 0px 0px 2px 0px;text-align:center;width:92%;">
                    Total Manual Ticket</p>

                <div class="row row-cols-1 row-cols-md-2"style="background: lightsteelblue;padding: 2rem;width: 96%;border-radius: 1rem;">
                    <x-widgets.counter-component gradient="scooter" name="Open Ticket" count="8"
                        border="border-info" countClass="text-info" icon="bi bi-cart" />
                    <x-widgets.counter-component gradient="bloody" name="Working Ticket" count="99"
                        border="border-danger" countClass="text-danger" icon="bi bi-people-fill" />
                    <x-widgets.counter-component gradient="ohhappiness" name="Pending Ticket" count="500"
                        border="border-success" countClass="text-success" icon="bi bi-wallet" />
                    <x-widgets.counter-component gradient="blooker" name="Solved Ticket" count="20"
                        border="border-warning" countClass="text-warning" icon="bi bi-collection" />
                </div>
            </div>
        </div>

    </x-slot>
</x-master>
