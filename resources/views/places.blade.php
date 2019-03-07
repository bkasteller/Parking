@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 30px;">
        <div class="col-md-8">
            <div class="card">
                <table>
                    <?php $i = 0; ?>
                    @foreach ($places as $place)
                        @if ( $i == 0 || $i%5 == 0 )
                            <tr>
                        @endif

                        @if ( $place->available )
                                <td style="text-align:center; border: 1px solid green;">
                        @else
                                <td style="text-align:center; border: 1px solid red;">
                        @endif
                                    <a href="/places/{{ $place->id }}">
                                        Place N° {{ $place->id }}
                                    </a>
                                    <br>
                                    @if ( $place->available )
                                        Assigned : No
                                        <br>
                                        Status : Open
                                        <br>
                                        <a href="">
                                            Close
                                        </a>
                                    @else
                                        /
                                        <br>
                                        Status : Close
                                        <br>
                                        <a href="">
                                            Open
                                        </a>
                                    @endif
                                </td>

                        @if ( $i%5 == 5 )
                            </tr>
                        @endif
                        <?php $i++; ?>
                    @endforeach
                </table>
                <a href="/places/add">
                    + Add one place
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
