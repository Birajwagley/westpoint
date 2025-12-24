<form action="{{ route('aboutus.update-card') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <table class="display table-auto" width="100%" id="cardTable">
        <tbody id="cardTableBody">
            @if (old('card_name_en'))
                @foreach ((array) old('card_name_en') as $key => $old)
                    @include('backend.about-us.partials.card.detail', [
                        'index' => $loop->index,
                    ])
                @endforeach
            @elseif($cards->isNotEmpty())
                @foreach ($cards as $card)
                    @include('backend.about-us.partials.card.detail', [
                        'index' => $loop->index,
                        'cardDetail' => $card,
                    ])
                @endforeach
            @else
                @include('backend.about-us.partials.card.detail', [
                    'index' => 0,
                ])
            @endif
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" class="text-right mt-2">
                    <button type="button"
                        class="mt-3 px-2 py-2 rounded-lg shadow-sm font-semibold text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                        id="add-card-btn">
                        <i class="fa fa-plus"></i> &nbsp;Add Card
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="flex mt-6 gap-2">
        <x-buttons.form-save-button type="Update" />
        <x-buttons.form-cancel-button href="{{ route('aboutus.edit') }}" />
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
            checkRowNumber('card-remove');
        });

        cardCount = {{ isset($cardCount) ? $cardCount - 1 : 0 }};
        $(document).on('click', '#add-card-btn', function() {
            cardCount = cardCount + 1;

            $.ajax({
                type: "GET",
                url: "{{ route('aboutus.get-card-detail') }}",
                data: {
                    index: cardCount,
                },
                success: function(response) {
                    $('#cardTableBody').append(response);
                }
            });

            checkRowNumber('card-remove');
        });

        $(document).on("click", ".card-remove", function() {
            $(this).closest(".card-detail").remove();

            checkRowNumber('card-remove');
        });

        function checkRowNumber(field) {
            if ($('.' + field).length === 1) {
                $('.' + field).hide();
            }
        }
    </script>
@endpush
