 <section class="reviewSection">
     <div class="container">
         <div class="common-heading text-l text-center">
             <h2 class="mb30 commonHeading2" style="margin-top: -3px; width: 60%; margin: auto">
                 Clients Are <span class="text-second text-bold">Saying</span>
             </h2>
             <p class="commonPara text-center">
                 {!! $metaData[Config::get('constants.CLIENT_SAYING')] !!}
             </p>
         </div>
         <div class="mainSliderouter row">
             @isset($reviews)
             @foreach ($reviews as $review)

             <div class="col-md-6">
                 <div class="card">
                     <div class="reviewProfile d-flex">
                         @if(File::exists(public_path($review->image)))
                         <img src="{{asset($review->image) }}" alt="img" />
                         @else
                         <img src="{{asset('assets/web/Images/Avatar.png') }}" alt="img" />
                         @endif
                         <div class="profileR" style="margin-left: 15px">
                             <p class="workPosition">{{ $review->title }}</p>
                             <p class="reviewName">{{ $review->user_name }}</p>
                         </div>
                     </div>
                     <div class="card-body">
                         {!! $review->description !!}
                         <div class="reviewimgOuter">
                             <span class="starPoint">{{ $review->rating }}.0</span>
                             <div class="full-stars-example-two">
                                 <x-rating :rating="$review->rating" :ratingId="$review->id " />

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             @endforeach
             @endisset
         </div>
     </div>
 </section>