<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_restaurants')->insert([
            [
                'restaurant_id' => 1,
                'menuName' => 'Spring Rolls',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/springroll.avif',
                'menuPrice' => 10000,
                'isAvailable' => 'YES',
                'description' => 'Crispy fried spring rolls filled with vegetables and served with a dipping sauce.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Chicken Nuggets',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/chickennugget.avif',
                'menuPrice' => 10000,
                'isAvailable' => 'YES',
                'description' => 'Crispy, golden fried chicken nuggets served with sweet and sour dipping sauce.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Grilled Steak',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/grillsteak.avif',
                'menuPrice' => 10000,
                'isAvailable' => 'YES',
                'description' => 'Juicy grilled steak served with mashed potatoes and steamed vegetables.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Spaghetti Carbonara',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/spaghetti.avif',
                'menuPrice' => 10000,
                'isAvailable' => 'YES',
                'description' => 'Pasta with a creamy carbonara sauce, crispy bacon, and grated Parmesan.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Cheesecake',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/cheesecake.webp',
                'menuPrice' => 10000,
                'isAvailable' => 'YES',
                'description' => 'Rich and creamy cheesecake topped with a strawberry glaze.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Chocolate Lava Cake',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/choco.webp',
                'menuPrice' => 20000,
                'isAvailable' => 'YES',
                'description' => 'Warm chocolate cake with a molten center, served with vanilla ice cream.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Iced Coffee',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/creamycoffee.jpg',
                'menuPrice' => 15000,
                'isAvailable' => 'YES',
                'description' => 'Refreshing cold brew coffee served with ice and a touch of cream.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Lemonade',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemonade.jpg',
                'menuPrice' => 17000,
                'isAvailable' => 'YES',
                'description' => 'A refreshing glass of freshly squeezed lemonade, served ice-cold.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Buffalo Wings',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/bufalowing.avif',
                'menuPrice' => 40000,
                'isAvailable' => 'YES',
                'description' => 'Spicy buffalo wings served with a side of blue cheese dip.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Caesar Salad',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/caesarsalad.avif',
                'menuPrice' => 50000,
                'isAvailable' => 'YES',
                'description' => 'Crisp romaine lettuce, croutons, Parmesan cheese, and Caesar dressing.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Tiramisu',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/tiramisu.webp',
                'menuPrice' => 23000,
                'isAvailable' => 'YES',
                'description' => 'Classic Italian dessert with layers of coffee-soaked ladyfingers and mascarpone cream.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Iced Tea',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemontea.jpg',
                'menuPrice' => 30000,
                'isAvailable' => 'YES',
                'description' => 'Refreshing iced tea served with a slice of lemon.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Fish Tacos',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/fishtacos.webp',
                'menuPrice' => 34000,
                'isAvailable' => 'YES',
                'description' => 'Soft corn tortillas filled with grilled fish, cabbage slaw, and avocado.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Garlic Bread',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/gralicbread.webp',
                'menuPrice' => 45000,
                'isAvailable' => 'YES',
                'description' => 'Warm, buttery garlic bread with a hint of parsley.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Cappuccino',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/coffeeCapucino.jpg',
                'menuPrice' => 19000,
                'isAvailable' => 'YES',
                'description' => 'Rich espresso topped with steamed milk and a frothy foam.'
            ],
            [
                'restaurant_id' => 1,
                'menuName' => 'Panna Cotta',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/pannacotta.webp',
                'menuPrice' => 24000,
                'isAvailable' => 'YES',
                'description' => 'Creamy Italian dessert made with sweetened cream, set with gelatin.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Fried Calamari',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/calamari.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Crispy fried calamari served with a tangy marinara dipping sauce.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Garlic Bread with Cheese',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/garlicbreadcheese.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Warm garlic bread topped with melted mozzarella and Parmesan cheese.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Grilled Chicken Sandwich',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/grillchicken.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Grilled chicken breast served with lettuce, tomato, and mayo on a toasted bun.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Mushroom Risotto',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/mushroomrisotto.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Creamy risotto with sautéed mushrooms and Parmesan cheese.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Beef Burger',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/beefburger.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Juicy beef patty with lettuce, tomato, pickles, and special sauce in a toasted bun.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Chocolate Mousse',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/chocolate.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Rich and creamy chocolate mousse topped with whipped cream.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Tiramisu',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/tiramisu1.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Classic Italian dessert with layers of coffee-soaked ladyfingers and mascarpone cream.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Lemonade',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemonade1.jpg',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Refreshing glass of freshly squeezed lemonade, served chilled.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Iced Orange',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/orange.jpg',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Chilled iced orange served with a lemon wedge.'
            ],
            [
                'restaurant_id' => 2,
                'menuName' => 'Hot Coffee',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/hotcoffee.jpg',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Espresso topped with steamed milk and a frothy foam.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Nachos Supreme',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/nachos.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Crispy tortilla chips loaded with melted cheese, jalapeños, sour cream, and guacamole.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Mozzarella Sticks',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/mozarellastick.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Golden, crispy mozzarella sticks served with marinara dipping sauce.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Lamb Shank',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/lambshank.webp',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Tender braised lamb shank served with mashed potatoes and a red wine sauce.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Grilled Salmon Fillet',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/grillsalmon.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Perfectly grilled salmon served with a side of steamed vegetables and a lemon wedge.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'BBQ Ribs',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/BBQRibs.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Juicy, tender ribs coated in BBQ sauce, served with coleslaw and fries.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Panna Cotta with Berries',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/pannacottaberry.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Smooth vanilla panna cotta topped with fresh mixed berries.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Chocolate Brownie',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/chocolatebrownies.avif',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Warm chocolate brownie served with caramel sauce and hot fudge.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Fruit Smoothie',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/smothies.jpg',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'A refreshing blend of fresh fruit and yogurt, perfect for a healthy boost.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Iced Latte',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/iceCoffee.jpg',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'Chilled espresso mixed with cold milk and ice, a refreshing coffee treat.'
            ],
            [
                'restaurant_id' => 3,
                'menuName' => 'Mango Lassi',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/mangojus.jpg',
                'menuPrice' => rand(10000, 50000),  // Dynamic price within the range of 10,000 to 50,000
                'isAvailable' => 'YES',
                'description' => 'A delicious yogurt-based drink blended with sweet mango puree.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Garlic Butter Shrimp',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/garlicbuttershrimp.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Shrimp sautéed in garlic butter with a hint of lemon.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Bruschetta',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/bruschetta.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Crispy toasted bread topped with diced tomatoes, basil, and olive oil.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Penne Arrabbiata',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/penne.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Penne pasta in a spicy tomato sauce with garlic and red chili flakes.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Chicken Alfredo',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/alfredo.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Grilled chicken served over fettuccine pasta with creamy Alfredo sauce.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Crème Brûlée',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/cremebrulee.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'NO',
                'description' => 'A rich custard dessert topped with a layer of caramelized sugar.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Chocolate Lava Cake',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/choco.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Warm, gooey chocolate cake with a molten center, served with vanilla ice cream.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Cold Brew Coffee',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/coffeeBrew.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Chilled cold brew coffee with a smooth and rich flavor.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Green Tea Latte',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/greentea.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Steamed milk and green tea, with a touch of honey.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Espresso',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/expresso.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Strong and bold espresso served hot.'
            ],
            [
                'restaurant_id' => 5,
                'menuName' => 'Pistachio Gelato',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/gelato.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Creamy pistachio gelato served cold.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Caprese Salad',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/caprese.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Fresh mozzarella, tomatoes, basil, and balsamic glaze.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Calzone',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/calzone.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Stuffed pizza dough filled with cheese, meats, and vegetables.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Grilled Veggie Wrap',
                'category' => 'Main Course',
                'menuImage' => 'menu/Appetizer/wrap.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A wrap filled with grilled vegetables, hummus, and fresh greens.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Margherita Pizza',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/pizza.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Classic pizza with tomato, mozzarella, and basil.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Tiramisu',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/tiramisu2.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Layers of coffee-soaked ladyfingers and mascarpone cream.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Panna Cotta',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/pannacottaberry.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Rich vanilla custard topped with fresh berries.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Berry Smoothie',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/berrysmothies.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A refreshing smoothie made with mixed berries and yogurt.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Lemonade',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemon.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Freshly squeezed lemonade served chilled.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Hot Tea',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/hottea.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A variety of hot teas available.'
            ],
            [
                'restaurant_id' => 6,
                'menuName' => 'Mint Mojito',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/minspark.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A refreshing cocktail with mint, lime, rum, and soda.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Crispy Calamari',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/calamari.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Golden-fried calamari served with marinara dipping sauce.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Chicken Wings',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/wings.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Buffalo wings served with blue cheese dipping sauce.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Baked Ziti',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/ziti.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Pasta baked with marinara sauce, mozzarella, and parmesan cheese.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Lasagna',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/lasagna.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Layers of pasta, ground beef, ricotta cheese, and marinara sauce.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Apple Tart',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/appletart.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'NO',
                'description' => 'A sweet and tart dessert made with fresh apples and a buttery crust.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Chocolate Mousse',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/mousse.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A creamy and rich chocolate mousse topped with whipped cream.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Iced Tea',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/icelemon.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A chilled, refreshing black tea served over ice.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Mocha Latte',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/mocca.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Espresso, steamed milk, and chocolate syrup with a touch of whipped cream.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Hot Cocoa',
                'category' => 'Beverages',
                'menuImage' => 'hot_cocoa.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A rich, creamy hot cocoa topped with whipped cream.'
            ],
            [
                'restaurant_id' => 7,
                'menuName' => 'Lemon Sorbet',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/sorbet.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A refreshing, tart lemon sorbet served cold.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Tuna Tartare',
                'category' => 'Appetizer',
                'menuImage' => 'tuna_tartare.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Fresh raw tuna mixed with avocado, lime, and seasonings.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Vegetarian Samosas',
                'category' => 'Appetizer',
                'menuImage' => 'vegetarian_samosas.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Deep-fried pastry filled with spiced potatoes, peas, and carrots.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Beef Wellington',
                'category' => 'Main Course',
                'menuImage' => 'beef_wellington.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Tender beef wrapped in puff pastry with a layer of pâté and mushrooms.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Mushroom Risotto',
                'category' => 'Main Course',
                'menuImage' => 'mushroom_risotto.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Creamy risotto made with earthy mushrooms and parmesan cheese.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Pavlova',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/pavlofa.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'NO',
                'description' => 'A meringue-based dessert topped with fresh fruit and whipped cream.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Banoffee Pie',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/banoffee.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A layered dessert with bananas, toffee, and whipped cream on a biscuit base.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Iced Latte',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/icelatte.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Espresso and milk over ice, perfect for a cool pick-me-up.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Frappe',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/dalgonacoffee.png',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A cold coffee blended with ice and topped with whipped cream.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Chai Latte',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/chai.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A spiced tea latte made with chai spices and steamed milk.'
            ],
            [
                'restaurant_id' => 8,
                'menuName' => 'Frozen Lemonade',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemonade2.jpg',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Frozen lemonade served in a slushy texture, perfect for a hot day.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Seared Scallops',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/seared.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Perfectly seared scallops served with a citrusy dressing.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Spring Rolls',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/springrollsauce.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Crispy rolls filled with vegetables and served with a dipping sauce.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Ribeye Steak',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/ribeye.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Juicy, tender ribeye steak served with mashed potatoes and grilled vegetables.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Shrimp Scampi',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/ShrimpScampi.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Shrimp in a garlic butter sauce, served with linguine pasta.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Churros',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/churros.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'NO',
                'description' => 'Fried dough sticks dusted with cinnamon sugar, served with chocolate dipping sauce.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Mango Sorbet',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/mangosorbet.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A sweet and refreshing mango sorbet served chilled.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Ice Tea Lemonade',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/icetealemonade.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A blend of iced tea and lemonade, refreshing and light.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Coconut Water',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/coconut.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Fresh and hydrating coconut water served chilled.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Peach Iced Tea',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/peach.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A sweet and fruity iced tea infused with peach flavor.'
            ],
            [
                'restaurant_id' => 9,
                'menuName' => 'Lemon Mint Cooler',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemonmint.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A refreshing mint lemonade served chilled.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Grilled Shrimp',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/grillshrimp.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Succulent shrimp grilled to perfection, served with garlic butter.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Charcuterie Board',
                'category' => 'Appetizer',
                'menuImage' => 'menu/Appetizer/charcuturie.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A selection of cured meats, cheeses, fruits, and nuts.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Grilled Salmon',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/grilledsalmon.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Fresh salmon fillet grilled and served with a side of steamed vegetables.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Chicken Parmesan',
                'category' => 'Main Course',
                'menuImage' => 'menu/Main/chickenparmesan.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Breaded chicken topped with marinara sauce and melted cheese.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Tiramisu',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/tiramisucoffee.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'NO',
                'description' => 'A classic Italian dessert made with layers of coffee-soaked ladyfingers and mascarpone cream.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Crème Brûlée',
                'category' => 'Dessert',
                'menuImage' => 'menu/Dessert/cremebrule.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A creamy custard dessert topped with a crisp layer of caramelized sugar.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Iced Espresso',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/hotexpresso.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A chilled espresso shot served over ice for a refreshing taste.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Lemonade Fizz',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/lemonadefizz.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A fizzy lemonade with a refreshing citrus flavor.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Cappuccino',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/capucino.webp',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'Espresso topped with a creamy froth of steamed milk.'
            ],
            [
                'restaurant_id' => 10,
                'menuName' => 'Fruit Smoothie',
                'category' => 'Beverages',
                'menuImage' => 'menu/Beverage/smothies.avif',
                'menuPrice' => rand(10000, 50000),
                'isAvailable' => 'YES',
                'description' => 'A blend of fresh fruit, yogurt, and ice for a healthy treat.'
            ]

        ]);
    }
}
