

<div class="modal-content">
    <div class="modal-header bg-blue">
        <h4 class="modal-title text-white"><i class="fa fa-shopping-cart"></i> تفاصيل الطلب</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body" id="message_body">	

        <form class="edit_status_form text-right assign" data-target="#order_status">
            @csrf
            <div class="form-group col-md-6 text-right">
                <label class="font-weight-bold" for="inputState">السائقين</label>
                <select id="inputState" name="edit_order_status" class="form-control">

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
            <input type="submit" value="Send Request" class="submit">
        </form>        
            

            <div class="row" style="border: 1px solid #ccc;padding: 10px;margin: 10px 15px;border-radius: 5px;box-shadow: 0 0 5px 1px rgba(204, 204, 204, 0.5);">
                <h5 class="col-md-12 mb-2"><i class="fa fa-info-circle"></i> البيانات</h5>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> الاسم </label> 
                    <h5 class="text-gray"> {{$order->Customer->name}} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> الهاتف </label> 
                    <h5 class="text-gray"> {{$order->Customer->phone}} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> البريد الالكتروني </label> 
                    <h5 class="text-gray"> {{$order->Customer->email}} </h5>
                </div>
                
                <div class="col-md-6 my-1 pb-2" style="border-bottom: 1px solid #ccc;">
                    <label class="font-weight-bold text-dark mb-1"> المنطقة </label> 
                    <h5 class="text-gray"> Mohandessen </h5>
                </div>
                
                <div class="col-md-12 my-1 pb-2">
                    <label class="font-weight-bold text-dark mb-1"> العنوان </label> 
                    <h5 class="text-gray"> {{$order->delivery_address}} </h5>
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
                            <th scope="row"> 1</th>
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
                <h3> الضريبة :</h3>
                <h4 class="my-2 cart_price">{{$order->sales_tax}} ريال سعودي</h4>
            </div>            

            <div class="container">
                <h3> التوصيل :</h3>
                <h4 class="my-2 cart_price">{{$order->delivery_fees}} ريال سعودي</h4>
            </div>  

            <div class="container">
                <h3>المجموع الفرعي :</h3>
                <h4 class="my-2 cart_price">{{$order->subtotal}} ريال سعودي</h4>
            </div>

            <div class="container">
                <h3>اجمالي المطلوب :</h3>
                <h4 class="my-2 cart_price">{{$order->total}} ريال سعودي</h4>
            </div>           

        </form>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
    </div>
</div>