<nav class="top-navbar">

    <div class="left">

        <button id="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <h4 class="text-success fw-bold mt-2"><?=  htmlspecialchars($shop["shop_name"] ?? '') ?></h4>

    </div>

    <div class="right">

					<div class="search-box">

			<form method="GET" action="index.php">

					<input
							type="hidden"
							name="page"
							value="search-customer">

					<input
							type="text"
							name="keyword"
							placeholder="Search Customer, Name">

					<button type="submit">

							<i class="fas fa-search"></i>

					</button>

			</form>

	</div>

        <!-- Notification -->
        <div class="notification">

            <i class="fas fa-bell"></i>

            <span>3</span>

        </div>

        <!-- Profile -->
        <div class="profile">

        <img src="<?= BASE_URL ?>uploads/logo/<?= htmlspecialchars($shop["logo"] ?? '') ?>">

            <span><?= htmlspecialchars($shop['owner_name'] ?? '') ?></span>

        </div>

    </div>

</nav>