<div class="row">
    <div class="ec-t-review-wrapper">

        @foreach($ratings as $rating)
        <div class="ec-t-review-item">
            <div class="ec-t-review-avtar">
                @if($rating->user['image'])
                <img src="{{ url('storage/'. $rating->user['image']) }}" alt="" />
                @else
                <img src="{{ url('assets/frontend/images/review-image/1.jpg') }}" alt="" />
                @endif
            </div>
            <div class="ec-t-review-content">
                <div class="ec-t-review-top">
                    <div class="ec-t-review-name">{{ $rating->user->name }}</div>
                    <div class="ec-t-review-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <=$rating->rating)
                            <i class="ecicon eci-star fill"></i> <!-- Full star -->
                            @else
                            <i class="ecicon eci-star-o"></i> <!-- Empty star -->
                            @endif
                            @endfor
                    </div>
                </div>
                <div class="ec-t-review-bottom">
                    <p>{{ $rating->review }}</p> <!-- Display review text -->
                </div>
            </div>
        </div>
        @endforeach



    </div>
    <div class="ec-ratting-content">
        <h3>Add a Review</h3>
        <div class="ec-ratting-form">
            <form wire:submit.prevent="storeRating">
                <div class="ec-ratting-star">
                    <span>Your rating:</span>
                    <div class="ec-t-review-rating input-rating" wire:ignore>
                        <i class="ecicon eci-star-o" wire:click="setRating(1)"></i>
                        <i class="ecicon eci-star-o" wire:click="setRating(2)"></i>
                        <i class="ecicon eci-star-o" wire:click="setRating(3)"></i>
                        <i class="ecicon eci-star-o" wire:click="setRating(4)"></i>
                        <i class="ecicon eci-star-o" wire:click="setRating(5)"></i>
                    </div>
                </div>
                <input type="hidden" wire:model="rating">

                <div class="ec-ratting-input form-submit">
                    <textarea name="your-commemt" placeholder="Enter Your Comment" wire:model="review"></textarea>
                    <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("livewire:init", function() {
        const stars = document.querySelectorAll(".input-rating i");
        // Update the UI based on the current rating
        function updateStars(rating) {
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('fill');
                    s.classList.add('eci-star');
                    s.classList.remove('eci-star-o');
                } else {
                    s.classList.remove('fill');
                    s.classList.remove('eci-star');
                    s.classList.add('eci-star-o');
                }
            });
        }

        // Set the current rating when the star is clicked
        stars.forEach((star, index) => {
            star.addEventListener('mouseover', function() {
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('fill');
                        s.classList.add('eci-star');
                        s.classList.remove('eci-star-o');
                    } else {
                        s.classList.remove('fill');
                        s.classList.remove('eci-star');
                        s.classList.add('eci-star-o');
                    }
                });
            });

            star.addEventListener('click', function() {
                const newRating = index + 1;
                @this.set('rating', newRating); // Set the rating
                updateStars(newRating); // Update the UI to reflect the new rating
            });

            star.addEventListener('mouseleave', function() {
                const currentRating = @this.rating;
                updateStars(currentRating); // Restore the UI to the current rating
            });
        });

        // Initialize stars to match the current rating
        updateStars(@this.rating);
    });
</script>