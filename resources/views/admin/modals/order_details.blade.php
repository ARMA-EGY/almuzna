

<div class="modal-content">
    <div class="modal-header bg-blue">
        <h4 class="modal-title text-white"><i class="fa fa-shopping-cart"></i> تفاصيل الطلب</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body text-right" id="message_body">	

        <form class="edit_status_form text-right assign" data-target="#order_status">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 text-right">
                    <label class="font-weight-bold" for="inputState">السائقين</label>
                    <select id="inputState" name="edit_order_status" class="form-control form-control-sm">

                    @if(!$order->driver_id) 

                        @foreach($dv_data as $sdv_data)
                            @if($sdv_data['count'] < 2 )
                                <option value="{{$sdv_data['driver']->id}}" > {{$sdv_data['driver']->name}} </option>
                            @endif
                        @endforeach
                    @else
                    <option value="s" > {{$order->Driver->name}} </option>
                    @endif
                    </select>
                </div>
                <input type="hidden" name="order_id" value="{{$order->id}}">

                <div class="form-group col-md-6 text-right">
                    <label class="font-weight-bold d-block" for="inputState"></label>
                    <button type="submit" class="btn btn-primary btn-sm mb-2 mt-4 submit">ارسال طلب للسائق</button>
                </div>
                
            </div>
        </form>        
            

            <div class="row" style="border: 1px solid #ccc;padding: 10px;margin: 10px 15px;border-radius: 5px;box-shadow: 0 0 5px 1px rgba(204, 204, 204, 0.5);">
                <h5 class="col-md-12 mb-2"><i class="fa fa-info-circle"></i> البيانات</h5>
                
                <div class="col-md-4 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> الاسم </label> 
                    <h5 class="text-gray"> {{$order->Customer->name}} </h5>
                </div>
                
                <div class="col-md-4 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> الهاتف </label> 
                    <h5 class="text-gray"> {{$order->Customer->phone}} </h5>
                </div>
                
                <div class="col-md-4 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> البريد الالكتروني </label> 
                    <h5 class="text-gray"> {{$order->Customer->email}} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> طريقة الدفع </label> 
                    <h5 class="text-gray"> @if ($order->payment_method == 'cash') عند الاستلام @elseif ($order->payment_method == 'visa') دفع الكتروني @elseif ($order->payment_method == 'wallet') من المحفظة @endif </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> تاريخ استلام الطلب </label> 
                    <h5 class="text-gray" dir="ltr">{{  date('j M, Y', strtotime($order->delivery_date))  }} </h5>
                </div>
                
                <div class="col-md-12 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> العنوان </label> 
                    <h5 class="text-gray" dir="ltr">{{ $order->delivery_address  }} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> اسم / رقم الشارع </label> 
                    <h5 class="text-gray" dir="ltr">{{ $order->street_no_name  }} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> اسم / رقم المبني </label> 
                    <h5 class="text-gray" dir="ltr">{{ $order->bulding_no  }} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> رقم الطابق </label> 
                    <h5 class="text-gray" dir="ltr">{{ $order->floor  }} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> رقم الشقة </label> 
                    <h5 class="text-gray" dir="ltr">{{ $order->apartment  }} </h5>
                </div>
                
                <div class="col-md-12 my-1 pb-2">
                    <label class="font-weight-bold text-dark mb-1"> ملاحظات </label> 
                    <h5 class="text-gray" >{{ $order->notes  }} </h5>
                </div>
                
            </div>
            
            <div class="col-sm-12">
                <div class="table-responsive mb-3" style="border: 1px solid #ccc;border-radius: 5px;">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">المنتج</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">السعر</th>
                            </tr>
                        </thead>
                        <tbody id="cart_table">
                @foreach($order->OrderItemsmodel as $OrderItem)

                            <tr>
                                <th scope="row"> {{ $loop->iteration }}</th>
                                <td class="font-weight-bold" style="font-size: 12px;"> <img class="rounded mr-2" src="" width="40">{{$OrderItem->Product->name_ar}}</td>
                                <td> {{$OrderItem->quantity}}</td>
                                <td> {{$OrderItem->total}} ريال سعودي</td>
                            </tr>

                @endforeach        
                        </tbody>
                    </table>
                </div>
            </div>
                


            <div class="container">
                <h3 class="d-inline-block"> ضريبة المبيعات :</h3>
                <span class="my-2 cart_price">{{$order->sales_tax}} %</span>
            </div>            

            <div class="container">
                <h3 class="d-inline-block"> قيمة التوصيل :</h3>
                <span class="my-2 cart_price">{{$order->delivery_fees}} ريال سعودي</span>
            </div>  

            <div class="container">
                <h3 class="d-inline-block">المجموع الفرعي :</h3>
                <span class="my-2 cart_price">{{$order->subtotal}} ريال سعودي</span>
            </div>
            <hr class="my-2">
            <div class="container">
                <h3 class="d-inline-block">اجمالي المطلوب :</h3>
                <span class="my-2 cart_price">{{$order->total}} ريال سعودي</span>
            </div>           

        </form>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
    </div>
</div>