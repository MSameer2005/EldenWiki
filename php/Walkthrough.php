<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
if (!$isLogged) {
    header('Location: LogIn.php');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Walkthrough</title>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

<div class="myVideo">
    <video autoplay class="myVideo" loop muted>
        <source src="../img/EldenRing.mp4" type="video/mp4">
    </video>
</div>

<header class="sfondo">
    <a href="Home.php"><h1>Elden Wiki</h1></a>
    <div class="menu">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Lore.php">Lore</a></li>
            <li><a href="Walkthrough.php">Walkthrough</a></li>
            <div class="dropdown">
                <li class="dropbtn">Equipment</li>
                <div class="dropdown-content">
                    <a href="Armi.php">Weapons</a>
                    <a href="Armature.php">Armor</a>
                    <a href="Incantesimi.php">Incantations</a>
                    <a href="Stregonerie.php">Sorcery</a>
                    <a href="CeneriDiGuerra.php">Ashes of War</a>
                </div>
            </div>
            <li><a href="EffettiStato.php">Status Effects</a></li>
            <li><a href="Contacts.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons">
        <img alt="Profilo" onclick="window.location.href='Profilo.php'"
             src="<?php echo "../" . $_SESSION['profilePicture']; ?>"
             style="border-radius: 50%"
             width="60px">
    </div>
</header>

<main class="sfondo">

    <section class="walkthrough">
        <h2 class="titolo">Walkthrough</h2>
        <ul>
            <li><span class="icon"></span>
                <h2>Your Character</h2>
                <p>
                    In this game, your character is referred to as The Tarnished.<br>
                    <br>
                    As any good RPG, you can create it however you want it to look. The looks won't have any effect in
                    the gameplay, so make your character as you please.<br><br>
                </p>
            </li>
            <li><span class="icon"></span>
                <h2>Chapel of Anticipation</h2>
                <p>
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-1.png">
                    You'll begin with your newly-customized character inside a chapel, the Chapel of Anticipation. Right
                    off that bat, you will be rewarded with the "The Ring" Gesture. Gestures are a common feature in
                    Souls games. They are emotes (physical actions) performed by your character to express different
                    ideas or emotions. Gestures can be useful or fun if playing with other Elden Ring players online,
                    and some gestures are used to accomplish different things in the game during solo play as well.<br>
                    <br>
                    Look to your right and you will see a body that is glowing, loot it and you'll find x1 Tarnished's
                    Wizened Finger. Head outside, go left, and cross the wooden bridge where you'll notice a large
                    statue ahead. As you approach, the Grafted Scion will come in, leaping from the air to attack you.
                    Just like any other Souls game, this boss is optional for you to defeat, but dying to the first boss
                    or at some point shortly after usually happens and is required for you to progress beyond — if you
                    do defeat the Grafted Scion, you'll be able to acquire some equipment that you can use later on once
                    you have leveled up and reached the required stats. But if not, you will have the opportunity to
                    travel back to this area when you are at a higher level later in the game.<br><br>
                </p>
            </li>
            <li><span class="icon"></span>
                <h2>Stranded Graveyard</h2>
                <p>
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-2.png">
                    Upon death, a short cutscene will lead you to the Stranded Graveyard. You'll automatically receive
                    x3 Flask of Crimson Tears for HP recovery and x1 Flask of Cerulean Tears for FP recovery. Ahead,
                    you'll see a ghostly Commoner in a chair; approaching it will reveal a message about an optional
                    tutorial area accessible by jumping down to the lower level of the cave. <br>
                    <br>
                    We recommend completing the tutorial, as it provides essential mechanics regardless of your
                    experience level, whether you are a new player or a veteran of FromSoftware's games. To skip the
                    tutorial, go up the stairs on the left, near the glowing golden sapling, and open the door at the
                    top. Inside, you'll find an empty room and another set of stairs leading to a Site of Grace.<br>
                    <br>
                    If you choose to take the tutorial, jump into the pit to encounter the Cave of Knowledge Site of
                    Grace and receive a tutorial message. Rest at this Site of Grace to prepare for combat
                    against undead and Noble soldier enemies. Use this opportunity to practice combat mechanics such as
                    backstabbing, melee attacks, and magic. The tutorial area is linear and covers basic game mechanics.<br>
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-3.png">
                    Beyond the Stake of Marika, you’ll encounter the boss, the Soldier of Godrick. Pass through the gold
                    fog to enter the boss arena. Soldier of Godrick is relatively weak, so a few hits should defeat him.
                    If you're using magic, a few spells will suffice. For melee combat, watch his attacks carefully,
                    block, guard, and dodge as needed. Defeating him grants 400 Runes.<br>
                    <br>
                    After the boss fight, head straight to find a hanging corpse from which you can loot the "Strength!"
                    Gesture. Jump down to return to the starting area with the ghost in the chair. Climb the stairs near
                    the glowing golden sapling and open the door to find the Site of Grace. Near the archway, there’s
                    another body on the right that you can loot for x1 Finger Severer and x2 Tarnished's Furled Finger.
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-4.png">
                    IMP STATUE — Whether or not you explored the tutorial section and fought Godrick, when you enter the
                    next area of the game you will see a double-headed imp statue on your right with white fog doors
                    nearby that block you from entering a different area. This statue requires two Stonesword Keys to
                    unlock the fog doors, though you will want to gain some more levels and gameplay experience before
                    exploring this area, which can be challenging if you visit it right away. This is the Fringefolk
                    Hero's Grave dungeon, which is populated with strong enemies, poison, and has a boss. We highly
                    recommend that you return to this section later on when you are well-equipped and prepared. One tip
                    is to mark sections that you would like to return to on your player map. If you do want to explore
                    this section later, you can find some valuable items, as long as you are careful and aware of your
                    surroundings.<br>
                    <br>
                    There is a site of grace near where the Imp Statue is that you should activate. Then, to officially
                    begin your journey through the Lands Between, head straight, ride the lift to the upper section,
                    climb the stairs, and open the iron door to find Limgrave.<br>
                </p>
            </li>
            <li><span class="icon"></span>
                <h2>Church of Elleh</h2>
                <p>
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-5.png">
                    Right off the bat, when you've arrived in the region of Limgrave, the first thing you should do
                    after speaking to the White-Faced Varré near the First Step Site of Grace is to visit the Merchant
                    Kalé who is at the Church of Elleh, the Church of Elleh can be located at the west. Just outside of
                    the front entrance, to your right, you'll see a crucifix that looks like a Martyr's Effigy, check
                    the base to acquire x1 Fringefolk's Rune. Now, be wary when you are traveling (on foot for now) to
                    the church since there is an optional boss, the Tree Sentinel who is roaming around. The Tree
                    Sentinel appears as a large knight on horseback, the boss wears shiny golden armor, both himself and
                    the horse. If you want to challenge yourself early on, you could fight him to obtain a useful
                    item.<br>
                    <br>
                    If you do find yourself in a situation where you aggro the boss by accident, you could try to run
                    away and keep your distance from it, however, running to the Church of Elleh will cause the boss to
                    try and chase you and will attempt to reach you by destroying the structure of the location.
                    As you travel along the game, you will notice a prompt that
                    says "Acquire Materials' when you are near items that you can pick up from the ground. In general,
                    always pick up anything you come across, since you can carry a lot of items in this game, and they
                    will be useful for crafting things later on in the game. Pick up any Rowa Fruit you come across and
                    kill some Sheep and other small animals for Thin Beast Bones. At the Church of Elleh, you'll find
                    the Merchant Kale (make sure to talk to him and exhaust his lines), the Church of Elleh Site of
                    Grace, and x1 Smithing Stone Shard (1) by examining the Smithing Table. You can buy the Crafting Kit
                    from the merchant's inventory as well.
                </p>
            </li>
            <li><span class="icon"></span>
                <h2>Meeting Melina and Renna</h2>
                <p>
                    Next up follow the guiding grace north to Gatefront Ruins. On
                    the way keep gathering ingredients in the woods, including Root Resin and Erdleaf Flower. Also kill
                    some Deer and Boar for more crafting materials. There is a Site of Grace, nearby, the Gatefront
                    site, so make sure to discover and use it first as a checkpoint (you can hug the cliff face going to
                    the west as you move to avoid the enemies at the campsite). At this point, a cutscene will trigger
                    upon resting at the site of grace and you'll meet Melina. Melina introduces herself when you've
                    discovered three sites of grace within the overland. As you speak to her, you'll be able to unlock
                    the feature of leveling up at Sites of Grace by using runes and you'll obtain the Spectral Steed
                    Whistle that allows you to summon your mount, Torrent. Moving forward, you can now use the Spectral
                    Steed Whistle to traverse the overland.<br>
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-6.png">
                    Before you move towards the Gatefront Ruins fast travel back to the Church of Elleh site at night
                    and you'll notice Merchant Kale unconscious and a mysterious figure that is sitting on a collapsed
                    section of the church's northern wall. This is Renna, speak to her and she will ask you about your
                    identity, answer her by saying that you have been gifted with the ability to summon the Spectral
                    Steed, she will then provide you with the Spirit Calling Bell, as well as the Lone Wolf Ashes. With
                    this, you can now summon the spirits of fallen creatures and characters to help aid you in combat.
                    Talk to her again and she will vanish.
                </p>
            </li>
            <li><span class="icon"></span>
                <h2>The Gatefront Ruins</h2>
                <p>
                    <img class="walkthrough-img" src="../img/tutorial/Tutorial-7.png">
                    Travel back to the Gatefront site of Gatefront Ruins and you'll see a Hearse on the left, there is a
                    chest on the right side of the Hearse where you'll see a Noble Stormveil Soldier guarding it. You
                    can sneak behind the enemy and backstab it and follow up with an attack in case the backstab doesn't
                    instantly kill the soldier. Open the chest to find x1 Lordsworn's Greatsword. There's another Hearse
                    nearby that also has a chest containing x1 Flail. You can sneak into the camp, just as long as you
                    are cautious of your surroundings, and grab the Map: Limgrave, West map fragment which can be looted
                    by a pillar that's at the center of the campsite.<br>
                    <br>
                    Now the area has a lot of Stormveil Soldiers here and Wolves, so the best way is to them out one by
                    one while they are unaware of your presence. If you are spotted, one of the soldiers will sound the
                    alarm, alerting all soldiers on the campsite to fight you. Take note as well of the elite soldier
                    here, the Godrick Knight, you'll easily see this enemy patrolling the center area of the campsite,
                    it holds a large shield, a spear, and a distinct helmet. Defeating it yields 260 Runes and drops x1
                    Partisan and x1 Godrick Knight Greaves.<br>
                    <br>
                    You're not done here, also around the center part of this location, there is an underground chamber
                    where you can find a chest that contains x1 Whetstone Knife and x1 Ash of War: Storm Stomp.
                    By using a Whetstone Knife, (although there may be some restrictions) you can use
                    any Ashes of War to replace the Skill, as well as Scaling Affinities on your armaments. Return and
                    take out the remaining enemies to farm Runes - you can also find the Agheel Lake North Site of Grace
                    nearby [Map Coordinates Here] - with enough Runes, we suggest you fast travel back to Church of
                    Elleh and buy the necessary items from Merchant Kale such as the Telescope, Cookbooks, a Torch,
                    Cracked Pot, and information items that can provide you with more gameplay mechanics.
                <h2>Continue...</h2>
                </p>
            </li>
        </ul>
    </section>

</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. Tutti i diritti riservati.</p>
</footer>
</body>

</html>