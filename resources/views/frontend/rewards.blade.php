<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Rewards</h1>
        </div>
</section>
  <section class="rewards-section">
    <div class="container-wrap">
      <h2 class="section-heading">FashionCraze Rewards Program</h2>
      <p class="section-description">
        Earn points every time you shop and enjoy exclusive perks! Join today and unlock a world of benefits with FashionCraze.
      </p>
      <div class="rewards-cards">
        <div class="reward-card">
          <img src="{{asset('frontend_assets/images/reward-points.png')}}"alt="Earn Points" class="reward-icon">
          <h3>Earn Points</h3>
          <p>Get rewarded for every purchase. Earn 10 points for every £1 spent.</p>
        </div>
        <div class="reward-card">
          <img src="{{asset('frontend_assets/images/discount-label.png')}}"alt="Exclusive Discounts" class="reward-icon">
          <h3>Exclusive Discounts</h3>
          <p>Redeem your points for discounts on your favorite items.</p>
        </div>
        <div class="reward-card">
          <img src="{{asset('frontend_assets/images/present-icon.png')}}"alt="Birthday Rewards" class="reward-icon">
          <h3>Birthday Rewards</h3>
          <p>Celebrate your special day with bonus points and surprises!</p>
        </div>
        <div class="reward-card">
          <img src="{{asset('frontend_assets/images/vip-card.png')}}"alt="VIP Access" class="reward-icon">
          <h3>VIP Access</h3>
          <p>Be the first to access sales, collections, and exclusive events.</p>
        </div>
      </div>
      <button class="btn">Join the Rewards Program</button>
    </div>
  </section>
    @include('frontend.partials.footer')
</body>
</html>
