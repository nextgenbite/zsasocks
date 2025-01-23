@extends('layouts.mail')


@section('content')
    <tr>
        <td valign="top">
            <!-- BEGIN MODULE: Order Summary -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                    <td class="pc-w620-spacing-0-0-0-0" style="padding: 0px 0px 0px 0px;">

                        <div
                            style="display: flex; align-items: center; justify-content: center; flex-direction: column; margin-top: 1.25rem; font-family : Nunito, sans-serif ">
                            <section style="max-width: 42rem; background-color: #fff;">


                                {{-- <div style="text-align : center; width : 100%; margin-top : 15px; ">
                                    <div style="font-weight : bold; font-size : 25px;">
                                        Thanks for <span style="position : relative">
                                            Signing up!

                                        </span>
                                    </div>
                                </div> --}}
                                <div style="width : 100%; height : 2px; background-color : #365CCE;"></div>
                                <main style="text-align : start; padding-left : 20px; padding-right : 20px;width : 100%">
                                    <div >
                                        <p><b>Sender:</b>{{ $data['name'] }}</p>
                                        <p><b>Email:</b>{{ $data['email'] }}</p>
                                        <p><b>Subject:</b>{{ $data['subject'] }}</p>
                                    </div>
                                    <p>
                                        {{ $data['message'] }}
                                    </p>
                                </main>
                            </section>
                        </div>


                    </td>
                </tr>
            </table>
            <!-- END MODULE: Order Summary -->
        </td>
    </tr>
@endsection
