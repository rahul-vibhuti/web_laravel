 <div class="rating-group">
    @for ($i = 1 ; $i <= 5 ; $i++) 
    <label aria-label="{{$i}} star" class="rating__label" for="ratin{{$ratingId}}-{{$i}}"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
    <input disabled {{ $i <= $rating  ? 'checked' : ''; }} class="rating__input" name="rating{{$ratingId}}" id="ratin{{$ratingId}}-{{$i}}" value="1" type="radio">

    @endfor


 </div>