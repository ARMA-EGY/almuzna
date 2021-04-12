                                                @if(isset($order))
                                                <div class="progress-block">
                                                    <!-- Title -->
                                                    <h3>ORDER {{$order['id']}}</h3>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Order status -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                                                            </div>
                                                            <div class="status">
                                                                <div>Status</div>
                                                                <div><span class="tag primary-tag order_status">{{$order['status']}}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <!-- Order date -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                                            </div>
                                                            <div class="date">
                                                                <div>Date</div>
                                                                <?php     
                                                    $timedv = strtotime($order['delivery_date']);
                                                    $delivery_date = date('M d Y',$timedv);
                                                                ?>
                                                                <div class="is-date">{{$delivery_date}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                </div>


                                                @if(isset($order['drivers']))

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Order status -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                                                            </div>
                                                            <div class="status">
                                                                <div>Driver Name</div>
                                                                <div><span class="tag primary-tag">{{$order['drivers']['name']}}</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <!-- Order date -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                                            </div>
                                                            <div class="date">
                                                                <div>Driver Number</div>
 
                                                                <div class="is-date">{{$order['drivers']['phone']}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                @endif

                                                
                                                <!-- Order details -->
                                                <div class="table-block">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col">Total</th>
                                                            </tr>
                                                        </thead>
                                                        
                                                        <tbody>
                                                            @foreach($order['order_itemsmodel'] as $item)
                                                            <tr>
                                                                <td data-label="Product">{{$item['productsmodel']['name_en']}}</td>
                                                                <td data-label="Quantity">{{$item['quantity']}}</td>
                                                                <td data-label="Total">{{$item['total']}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-7">
                                                    </div>
                                                    <!-- Total subtable -->
                                                    <div class="col-md-5">
                                                        <table class="table table-sm sub-table text-right my-4">
                                                            <tbody><tr>
                                                                <td><span class="subtotal">Subtotal</span></td>
                                                                <td class="text-right"><span class="subtotal-value">{{$order['subtotal']}}</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="vat">VAT</span></td>
                                                                <td class="text-right"><span class="vat-value">{{$order['sales_tax']}}</span></td>
                                                            </tr>

                                                            <tr>
                                                                <td><span class="vat">Delivery Fees</span></td>
                                                                <td class="text-right"><span class="vat-value">{{$order['delivery_fees']}}</span></td>
                                                            </tr>                                                           
                                                            <tr>
                                                                <td><span class="total">Total</span></td>
                                                                <td class="text-right"><span class="total-value">{{$order['total']}}</span></td>
                                                            </tr>
                                                        </tbody></table>
                                                    </div>
                                                </div>

                                                <div class="row order_actions">
                                                    @if($order['status'] == 'delivered')
                                                        <button>Reorder</button>
                                                    @elseif($order['status'] == 'pending')   
                                                        <button class="order_cancel" data-id="{{$order['id']}}">Cancel</button>
                                                        <br>
                                                        <button class="order_track">Track</button>
                                                    @endif
                                                </div>
                                                @endif