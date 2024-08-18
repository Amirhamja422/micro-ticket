
<x-master>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="content_area">
        <div class="row">
            <div class="col-md-6"><p class="pera">Total Email Ticket</p>
                <div class="row row-cols-1 row-cols-md-2 main_div">
                     <x-widgets.counter-component
                        gradient="scooter" name="Open Ticket" count="{{ $data['openTicket'] }}"
                        border="border-info" countClass="text-info"
                        icon="bi bi-envelope-open" />
                        <x-widgets.counter-component
                        gradient="bloody" name="Working Ticket" count="{{ $data['workingTicket'] }}"
                        border="border-danger" countClass="text-danger"
                        icon="bi bi-envelope-plus-fill" />
                        <x-widgets.counter-component
                        gradient="ohhappiness" name="Pending Ticket" count="{{ $data['pendingTicket'] }}"
                        border="border-success" countClass="text-success"
                        icon="bi bi-envelope-fill" />
                        <x-widgets.counter-component
                        gradient="blooker" name="Solved Ticket" count="{{ $data['solveTicket'] }}"
                        border="border-warning" countClass="text-warning"
                        icon="bi bi-envelope-check-fill" />
                </div>
            </div>

            <div class="col-md-6"><p class="pera">
                    Total Manual Ticket</p>
                <div class="row row-cols-1 row-cols-md-2 main_div">
                    <x-widgets.counter-component gradient="scooter" name="Open Ticket"  count="{{ $data['openManualTickets'] }}"
                        border="border-info" countClass="text-info" icon="bi bi-cart" />
                        <x-widgets.counter-component gradient="bloody" name="Working Ticket"  count="{{ $data['workingManualTickets'] }}"
                        border="border-danger" countClass="text-danger" icon="bi bi-people-fill" />
                        <x-widgets.counter-component gradient="ohhappiness" name="Pending Ticket"  count="{{ $data['pendingManualTickets'] }}"
                        border="border-success" countClass="text-success" icon="bi bi-wallet" />
                        <x-widgets.counter-component gradient="blooker" name="Solved Ticket"  count="{{ $data['solvedManualTickets'] }}"
                        border="border-warning" countClass="text-warning" icon="bi bi-collection" />
                </div>
            </div>
        </div>

    </x-slot>
</x-master>



{{--


<x-master>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="content_area">
        <style>
            .page-wrapper {
                padding-left: 0px;
                padding-right: 0px;
            }
            .widget {
                padding: 1.5rem;
                background-color: #fff;
                border-radius: 1rem;
                box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                text-align: center;
                margin-bottom: 1.5rem;
            }
            .widget-title {
                font-weight: bold;
                font-size: 1.2rem;
                color: #333;
                margin-bottom: 1rem;
            }
            .row-cols-md-2 > * {
                margin-bottom: 1rem;
            }
        </style>
        <div class="row">
            <div class="col-md-6">
                <div class="widget">
                    <p class="widget-title">Total Email Ticket</p>
                    <div class="row row-cols-1 row-cols-md-2">
                        <x-widgets.counter-component
                            gradient="scooter" name="Open Ticket" count="{{ $data['openTicket'] }}"
                            border="border-info" countClass="text-info"
                            icon="bi bi-envelope-open" />
                        <x-widgets.counter-component
                            gradient="bloody" name="Working Ticket" count="{{ $data['workingTicket'] }}"
                            border="border-danger" countClass="text-danger"
                            icon="bi bi-envelope-plus-fill" />
                        <x-widgets.counter-component
                            gradient="ohhappiness" name="Pending Ticket" count="{{ $data['pendingTicket'] }}"
                            border="border-success" countClass="text-success"
                            icon="bi bi-envelope-fill" />
                        <x-widgets.counter-component
                            gradient="blooker" name="Solved Ticket" count="{{ $data['solveTicket'] }}"
                            border="border-warning" countClass="text-warning"
                            icon="bi bi-envelope-check-fill" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget">
                    <p class="widget-title">Total Manual Ticket</p>
                    <div class="row row-cols-1 row-cols-md-2">
                        <x-widgets.counter-component gradient="scooter" name="Open Ticket"  count="{{ $data['openManualTickets'] }}"
                            border="border-info" countClass="text-info" icon="bi bi-cart" />
                        <x-widgets.counter-component gradient="bloody" name="Working Ticket"  count="{{ $data['workingManualTickets'] }}"
                            border="border-danger" countClass="text-danger" icon="bi bi-people-fill" />
                        <x-widgets.counter-component gradient="ohhappiness" name="Pending Ticket"  count="{{ $data['pendingManualTickets'] }}"
                            border="border-success" countClass="text-success" icon="bi bi-wallet" />
                        <x-widgets.counter-component gradient="blooker" name="Solved Ticket"  count="{{ $data['solvedManualTickets'] }}"
                            border="border-warning" countClass="text-warning" icon="bi bi-collection" />
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-master>
 --}}


 {{-- <x-master>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="content_area">
        <style>
            .page-wrapper {
                padding-left: 0px;
                padding-right: 0px;
            }
            .widget {
                padding: 1.5rem;
                background-color: #fff;
                border-radius: 1rem;
                box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                text-align: center;
                margin-bottom: 1.5rem;
                animation: slideInUp 0.5s ease forwards;
            }
            .widget-title {
                font-weight: bold;
                font-size: 1.2rem;
                color: #333;
                margin-bottom: 1rem;
            }
            .row-cols-md-2 > * {
                margin-bottom: 1rem;
            }

            /* Animation Keyframes */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(50px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        <div class="row">
            <div class="col-md-6">
                <div class="widget">
                    <p class="widget-title">Total Email Ticket</p>
                    <div class="row row-cols-1 row-cols-md-2">
                        <x-widgets.counter-component
                            gradient="scooter" name="Open Ticket" count="{{ $data['openTicket'] }}"
                            border="border-info" countClass="text-info"
                            icon="bi bi-envelope-open" />
                        <x-widgets.counter-component
                            gradient="bloody" name="Working Ticket" count="{{ $data['workingTicket'] }}"
                            border="border-danger" countClass="text-danger"
                            icon="bi bi-envelope-plus-fill" />
                        <x-widgets.counter-component
                            gradient="ohhappiness" name="Pending Ticket" count="{{ $data['pendingTicket'] }}"
                            border="border-success" countClass="text-success"
                            icon="bi bi-envelope-fill" />
                        <x-widgets.counter-component
                            gradient="blooker" name="Solved Ticket" count="{{ $data['solveTicket'] }}"
                            border="border-warning" countClass="text-warning"
                            icon="bi bi-envelope-check-fill" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget">
                    <p class="widget-title">Total Manual Ticket</p>
                    <div class="row row-cols-1 row-cols-md-2">
                        <x-widgets.counter-component gradient="scooter" name="Open Ticket"  count="{{ $data['openManualTickets'] }}"
                            border="border-info" countClass="text-info" icon="bi bi-cart" />
                        <x-widgets.counter-component gradient="bloody" name="Working Ticket"  count="{{ $data['workingManualTickets'] }}"
                            border="border-danger" countClass="text-danger" icon="bi bi-people-fill" />
                        <x-widgets.counter-component gradient="ohhappiness" name="Pending Ticket"  count="{{ $data['pendingManualTickets'] }}"
                            border="border-success" countClass="text-success" icon="bi bi-wallet" />
                        <x-widgets.counter-component gradient="blooker" name="Solved Ticket"  count="{{ $data['solvedManualTickets'] }}"
                            border="border-warning" countClass="text-warning" icon="bi bi-collection" />
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-master> --}}
