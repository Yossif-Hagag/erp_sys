@foreach ($expenses as $expense)
    <tr>
        <td> {{ $x++ }}</td>
        <td> {{ $expense->amount }}</td>
        <td> {{ $expense->reason }}</td>
        <td> {{ $expense->recipient }}</td>
        <td> {{ $expense->created_at }}</td>
        <td>
            <a type="button" id="edt_expense" data-bs-toggle="modal" data-bs-target="#modalexpense{{ $expense->id }}"
                class="btn btn-sm collection text-primary"><i class="fa-solid fa-edit"></i></a>


            <!-- edt modalexpense -->
            <div class="modal fade" id="modalexpense{{ $expense->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="alerting_modal"></div>
                        <div class="modal-header">
                            <h5 class="modal-title">تعديل مصروفات</h5>
                            <button type="button" class="m-0 btn-close fw-bold" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="addsales">
                                <form class="row g-3" method="post" action="{{ route('edt_expense', $expense->id) }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="number" name="amount" class="form-control"
                                                placeholder="المبلغ" value = "{{ old('amount', $expense->amount) }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col">
                                            <textarea name="reason" class="form-control" placeholder="سبب الصرف" required cols="5" rows="3">{{ old('reason', $expense->reason) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col">
                                            <input type="text" name="recipient" class="form-control"
                                                placeholder="المستلم"
                                                value = "{{ old('recipient', $expense->recipient) }}" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            name="button_add_submit">تعديل</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">إغلاق</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end edt modalexpense -->

        </td>
    </tr>
@endforeach
