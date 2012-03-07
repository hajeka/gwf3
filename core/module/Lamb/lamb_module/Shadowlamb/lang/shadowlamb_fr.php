<?php
$c = "#";
$b = chr(2);
/**
 * Please respect weird punctuations when doing human readable translations
 * Examples: .leading dot. missing dots,  leading spaces Etc. 
 */
$lang = array(
############
### Bits ###
############
# Tiny bits
'name' => 'Nom',
'none' => 'Aucun',
'over' => 'Plus',
'items' => 'Articles',
'mount' => 'Augmenter',
'unknown' => 'Inconnu',
'unknown_contr' => 'Constructeur inconnu',
'modifiers' => " {$b}Modificateurs{$b}: %s.", # statlist
'm' => 'm', # metres
'g' => '%dg', # gram
'kg' => '%.02fkg', # kilogram
'busy' => '%s occupé.', # duration
'eta' => 'ETA: %s.', # duration
'hits1' => ', frappe %s avec %s de dégâts', # player, damage
'hits2' => ', frappe %s avec %s(%s/%s)HP restant', # player, damage, hp left, max hp
'kills' => ', tue %s avec %s', # player, damage
'loot_nyxp' => '. Vous ramassez %s et %.02f XP',
'page' => 'page %d/%d: %s.',
'from_brewing' => 'mélange options magiques',
'members' => '%d membres',
'of' => '_avec_', # MIT, AVEC, CON

# Options
'opt_help' => 'Aide',
'opt_lock' => 'Equipement bloqué',
'opt_bot' => 'Botflag Joueur',
'opt_norl' => 'Permleader',
'enabled' => 'activé',
'disabled' => 'désactivé',

# Item types
'Item' => 'Item',
'Potion' => 'Potion',
'LvlupScroll' => 'LvlupScroll',
'Ammo' => 'Ammo',
'Amulet' => 'Amulet',
'Armor' => 'Armor',
'Boots' => 'Boots',
'Food' => 'Food',
'Drink' => 'Drink',
'Cyberdeck' => 'Cyberdeck',
'Cyberware' => 'Cyberware',
'Earring' => 'Earring',
'Bow' => 'Bow',
'Pistol' => 'Pistol',
'Shotgun' => 'Shotgun',
'SMG' => 'SMG',
'HMG' => 'HMG',
'Helmet' => 'Helmet',
'Legs' => 'Legs',
'Magic Weapon' => 'Magic Weapon',
'Melee Weapon' => 'Melee Weapon',
'Sword' => 'Sword',
'Axe' => 'Axe',
'Mount' => 'Mount',
'Ninja Weapon' => 'Ninja Weapon',
'Quest Item' => 'Quest Item',
'Ring' => 'Ring',
'Rune' => 'Rune',
'Shield' => 'Shield',
'Usable' => 'Usable',
'Heal Item' => 'Heal Item',

# PrintF-Formats
'fmt_examine' => '%s est %s%s. %s%s%s%s%s%s%s%s%s', # Ouch
'fmt_list' => ', %s', # item
'fmt_gain' => '%s%.02f(%.02f/%.02f)%s', # sign, gain, now, max, unit
'fmt_asl' => "{$b}Age{$b}:%d, %dcm %s", # age, height, weight
'fmt_requires' => " {$b}Nécessite{$b}: %s.", # statted list
'fmt_stats' => ", {$b}%s{$b}:%s%s", # stat-long, base, (now), stat, now
'fmt_cityquests' => ', %s(%.01f%%)', # cityname, percent
'fmt_sumlist' => ", {$b}%s{$b}-%s(%s)", # enum, playername, summand
'fmt_quests' => ", %1\$s%2\$d%1\$s-%3\$s", # boldy, id, name
'fmt_rawitems' => ", {$b}%s{$b}-%s", # id, itemname
'fmt_items' => ", {$b}%s{$b}-%s%s", # id, itemname, (amt), amt
'fmt_effect' => ", {$b}%s{$b}:%s(%s)", # stat, gain, duration
'fmt_equip' => ", {$b}%s{$b}:%s", # long type, item, short type
'fmt_hp_mp' => ", {$b}%1\$s{$b}-%2\$s%5\$s(%3\$s/%4\$s)%5\$s", # $member->getEnum(), $member->getName(), $hpmp, $hpmmpm, $b2, $b1
'fmt_spells' => ", {$b}%s{$b}-%s:%s%s", # id, spellname, base, (adjusted), adjusted
'fmt_lvlup' => ', %4$s%1$s%4$s:%2$s(%4$s%3$s%5$s%4$s)', # field, tobase, karma, bold, K, couldbit
'fmt_giveitems' => ", {$b}%s x %s{$b}", # amt, itemname
'fmt_bazar_shop' => ", %dx{$b}%s{$b}(%s)", # itemcount, itemname, price
'fmt_bazar_shops' => ", {$b}%s{$b}(%d)", # player, itemcount
'fmt_bazar_search' => ", \"{$b}%s %s{$b}\"(%sx%s)", # player, itemname, amount, price

# Party actions in "You are %s", "Your party is %s", (UGLY)
'empty_party' => 'une partie vide',
'pa_delete' => "{$b}en train d'être supprimé{$b}.",
'pa_talk' => "{$b}en train de parler{$b} à %s. %s restant. Dernière action: %s", # enemy party, duration, last action
'pa_fight' => "{$b}en train de te battre{$b} contre %s. Dernière action: %s", # enemy party last action.
'pa_inside' => "{$b}à l\'intérieur de{$b} %s.", # location
'pa_outside1' => "{$b}à l\'extérieur de{$b} of %s.", # location
'pa_outside2' => "quelque part à l\'intérieur de %s.", # location
'pa_sleep' => "{$b}en train de dormir{$b} inside %s.", # location
'pa_travel' => "{$b}en train de voyager{$b} à %s. %s restant.", # location, duration
'pa_explore' => "{$b}en train d\'explorer{$b} %s. %s restant.", # location, duration
'pa_goto' => "{$b}en train de partir{$b} à %s. %s restant.", # location, duration
'pa_hunt' => "{$b}en train de poursuivre{$b} %s. %s restant.", # location, duration
'pa_hijack' => "{$b}en train de détourner{$b} %s à %s. %s restant.", # playername, location, duration

# Quest states
'qu_open' => 'Ouvrir',
'qu_deny' => 'Refuser',
'qu_done' => 'Fait',
'qu_fail' => 'Abandonner',
'qu_abort' => 'Abandonner',
'qu_All' => 'Tout',
'qu_Browse' => 'Navigue',

# Sums
'sum_age' => 'ages',
'sum_bmi' => 'masse corporelle',
'sum_height' => 'hauteurs',

# Stubs
'stub_found' => 'tu as trouvé %s. Il n\'y a pas encore de description.', # location
'stub_enter' => 'tu entres dans le %s. Il n\'y a pas encore de texte.', # location
'stub_shop_slogan' => 'Bienvenue à %s Boutique.', # player
# XXX: Translate
'stub_found_bazar' => 'You found the local bazar, a place where you can offer your items and purchase them.',
'stub_enter_bazar' => 'You enter the bazar. You see %d shops with a total of %d items.', # shopcount, itemcount
'stub_found_clanhq' => 'You found the clan headquarters.',
'stub_enter_clanhq' => 'You enter the clan headquarters.',
'stub_found_elevator' => 'You found the %s. A sign reads: "MAX %s KG".',
'stub_enter_elevator' => 'You enter the %s. A sign reads: "MAX %s KG".',
'stub_found_bank' => 'You found the Bank of %s. All transactions are done with slot machines.',
'stub_enter_bank' => 'You enter the Bank of %s. You see some customers at the counters and also some security officers.',
'stub_found_blacksmith' => 'You find a small store, "The Blacksmith". It seems like they can upgrade your equipment here.',
'stub_enter_blacksmith' => 'You enter the %s blacksmith. You see two dwarfs at the counter.',
'stub_found_hospital' => 'You found the local hospital. The sign reads: "Renraku Cyberware 20% off".',
'stub_enter_hospital' => 'You enter the huge building and are guided to a doctor.',


# Clan history
'ch_0' => '%s crée le groupe %s.', # player, clanname
'ch_1' => '%s demande à joindre votre groupe en tant que membre #%s.', # player, membernum
'ch_2' => '%s a rejoint votre groupe en tant que membre #%s.', # player, membernum
'ch_3' => '%s a quitté votre groupe et il détient maintenant %s membres.', # player, amt
'ch_4' => "{$b}%s{$b}: \"%s\"", # player, message
'ch_5' => '%s a poussé %s dans le groupebanque.', # player, nuyen
'ch_6' => '%s a retiré %s du groupebanque.', # player, nuyen
'ch_7' => '%s a mis %s %s dans le groupebanque.', # player, amt, item 
'ch_8' => '%s a retiré %s %s du groupebanque.', # player, amt, item
'ch_9' => '%s a acheté plus de fente et le groupe peut contenir jusqu\'à %s.', # player, memberslots
'ch_10' => '%s a acheté plus de nuyen et le groupe peut contenir jusqu\'à %s.', # player, maxnuyen
'ch_11' => '%s a acheté plus d\'espace et le groupe peut contenir jusqu\'à %s.', # player, maxstorage

# Bounty
'meet_bounty' => " Il y a une {$b}prime{$b} sur %s.", # sumlist
'no_bounty' => 'Ce joueur n\'a pas de primes.',
'total_bounty' => "Il y a un total de {$b}primes sur %s{$b} pour %s: %s.", # total, player, details
'no_bounties' => 'Il n\'y a pas de primes pour le moment.',
'bounty_page' => 'Primes page %s/%s: %s.',

# Bad karma
'info_bk' => ', %s a %d mauvais_karma', # player, badkarma

# Ingame help
'hlp_in_outside' => 'Lorsque vous trouver des endroits, vous êtes en dehors d\'eux. Utiliser #goto ou #enter pour entrer à l\'intérieur. Vous pouvez #(exp) encore pour trouver plus d\'endroit.',
'hlp_clan_enter' => "Rejoignez un groupe {$c}abandon, {$c}request et {$c}accept. Créer un groupe avec {$c}create. Achetez plus d\'espace et de devises avec {$c}manage. Installer les options avec {$c}toggle. Accéder au groupe banque avec {$c}push, {$c}pop et {$c}view, groupe argent avec {$c}pushy et {$c}popy.",
# XXX: Translate
'hlp_bank' => "In a bank you can use #push and #pop to bank items, and #pushy and #popy to store nuyen. Use #view to list or search your banked items. Every transaction costs %s for you.",
'hlp_bazar' => "In the bazar you can sell your items. You can use #push, #pop, #view, #search, #buy, #bestbuy, #buyslot, #slogan and #price here.",
'hlp_elevator' => 'In elevators you can use #up, #down and #floor.',
'hlp_exit' => 'You can return to this location to #leave the building.',
'hlp_hotel' => 'You can pay %s to #sleep here and restore your party`s HP/MP.',
'hlp_hack' => ' You can use a Cyberdeck here to hack into a computer.',
'hlp_search' => ' You can use #search here to search the room for items.',
'hlp_second_hand' => 'You can sell statted items to higher prices here. The statted items that get sold here will stay in the shop.',
'hlp_store' => 'In this store you can use %s.',
'hlp_cyberdeck' => 'This item only works inside locations with computers.',
'hlp_cyberdeck_targets' => 'You don\'t see any Computers with a Headcomputer interface here.',
'hlp_start' => "{$b}Known races{$b}: %s. {$b}Known genders{$b}: %s.",
'hlp_blacksmith' => "At a blacksmith you can #upgrade equipment with runes. You can also #break items into runes or #clean them. It is also possible to #split runes. Also #view, #buy and #sell works here.",
'hlp_hospital' => 'Use #talk <topic> to talk to the doctor. Use #view, #implant and #unplant to manage your cyberware. Use #heal to pay some nuyen and get healed. Use #surgery to revert lvlup into karma.',

# Start storyline
# XXX: Translate
'start_1' => "You wake up in a bright room... It seems like it is past noon...looks like you are in a hotel room.",
'start_2' => "What happened... You can`t remember anything.... Gosh, you even forgot your name.",
'start_3' => "You check your {$b}#inventory{$b} and find a pen from 'Renraku Inc.'. You leave your room and walk to the counter. Use {$b}#talk{$b} to talk with the hotelier.",
'start_4' => "Use {$b}#c{$b} to see all available commands. Check {$b}#help{$b} to browse the Shadowlamb help files. Use #help <cmd> to see the help for a command.",

# Knowledge
'ks_words' => 'Mot',
'ks_spells' => 'Sort',
'ks_places' => 'Place',
'kp_words' => 'Mots',
'kp_spells' => 'Sorts',
'kp_places' => 'Places',


##########################
#   0000-4999   = Erreurs #
##########################
'0000' => 'Vous n\'avez pas #start le jeu pour l\'instant.',
'0001' => 'Vous devez vous connecter pour jouer.',
		
'1002' => 'Vous devez avoir au moins le niveau %d pour crier.', # level
'1003' => 'S\'il vous plaît attendre %s avant de crier encore.', # duration
'1004' => 'Vous n\'avez de quêtes  %s.', # section
// '1005' => 'Vous ne connaissez aucun mot.',
'1006' => 'Vous ne répondez pas aux exigences: %s.', # statted-list
'1007' => 'Pas d\'articles trouvés correspondant au modèle recherché.',
'1008' => 'il n\'y a pas d\'articles ici.',
'1009' => 'Pas cette page!',
'1010' => 'Il n\'y a pas de quêtes ici.',
'1011' => 'Vous n\'avez pas configuré votre asl avec {$b}#aslset{$b} pour l\'instant. Vous avez besoin de faire cela pour commencer a bouger dans le jeu.',
'1012' => 'La cible est inconnue.',
'1013' => 'Vous ne pouvez pas utiliser cet article.',
'1014' => 'Vous ne pouvez pas équiper cet article.',
'1015' => 'Votre parti (niveau total %d) ne peut pas attaquer un parti ayant pour niveau total %d parce que la différence de niveau est plus de  %d.',
'1016' => 'Vous avez déjà mis votre asl à: %s.', # aslstring
'1017' => 'Ce joueur est inconnu ou non dans la mémoire.',
'1018' => 'Ce nom de joueur est ambigüe. essayer un {server} version.',
'1019' => 'Vous n\'êtes pas dans un groupe, chummer.',
'1020' => 'Je ne connais pas l\'article "%s".', # itemname
'1021' => 'Vous n\'avez rien de comparable à "%s" équipe.', # itemname
'1022' => 'Vous n\'êtes pas dans un magasin.',
'1023' => 'Vous n\'avez pas cette connaissance.',
'1024' => 'Vous pouvez augmenter votre niveau pour les attributs, Talents, connaissances et incantations. Vous pouvez aussi augmenter votre niveau essence.',
'1025' => 'Vous devez apprendre %s en premier.', # field
'1026' => 'Vous avez déjà atteint le niveau maximum de %d pour %s.',
'1027' => 'Vous avez besoin de %d karma pour augmenter votre niveau de %s de %d pour %d, Mais vous avez seulement %d karma.',
'1028' => '%s n\'est pas là ou le nom est ambiguë.',
'1029' => 'Vous n\'avez pas cet article.',
'1030' => 'Vous ne pouvez permuter les mêmes choses.',
'1031' => 'Vous n\'êtes pas en dehors d\'un emplacement.',
'1032' => 'Vous n\'êtes pas le leader du parti.',
'1033' => 'Le parti est en train de bouger. Essayez cette commande en cas d\'inactivité.',
'1034' => 'Vous ne pouvez pas passer en mode de fonctionnement lorsque vous avez passé le niveau 2.',
'1035' => 'Dans les donjons vous n\'avez pas de montures.',
'1036' => 'Cette commande ne fonctionne pas dans le combat.',
'1037' => 'Vous ne pouvez pas stocker des éléments dans cette monture.',
'1038' => 'S\'il vous plaît spécifier un montant positif de cet article.',
'1039' => 'Vous ne pouvez pas mettre la monture %s.', # mount name
'1040' => 'vous n\'avez pas beaucoup de %s.',
'1041' => 'Votre %s(%s/%s) n\'a place pour  %d de votre %s (%s).', # mountname, stored, storage, amt, itemname, weight
'1042' => 'Vous n\'avez pas cet article dans votre monture.',
'1043' => 'Vous n\'avez pas beaucoup de %s dans votre %s.', # itemname, mountname
'1044' => 'S\'il vous plaît attendre %s avant de crier à nouveau.',  # duration
'1045' => 'Plusieurs joueurs chuchote de vous, donc je quitte avec ce message.',
'1046' => 'Personne ne vous chuchote de vous depuis %s.', # duration
'1047' => 'Vous devez apprendre l\'alchimie en premier.',
'1048' => 'Vous n\'avez pas ce sort.',
'1049' => 'Vous n\'avez pas le sort %s sur ce niveau élevé.', # spellname
'1050' => 'Vous n\'avez pas une bouteille d\'eau.',
'1051' => 'Mélange de la potion échoué et la bouteille est perdue.',
'1052' => 'Le sort "%s" marche seulement en combat.', # spellname
'1053' => 'Vous ne pouvez pas lancer un sort avec un niveau inférieur à 0.',
'1054' => 'Vous ne pouvez pas lancer %s niveau %s parce que votre sort est seulement à %s.', # spellname, levelneed, levelhave 
'1055' => 'Vous avez besoin de %s MP pour lancer %s, Mais vous avez seulement %s.', # needmp, spellname, #havemp
'1056' => 'Vous avez échouer pour lancer %s. %s MP gaspillé.%s',
'1057' => 'Le %s de %s échoué.', # spellname, player
'1058' => 'Vous ne devez pas changer cet article.',
'1059' => 'Vous ne pouvez pas changer votre équipement au combat quand il est verrouillé.',
'1060' => 'Vous ne pouvez pas attaquer ce parti à nouveau. S\'il vous plaît attendre %s.', # duration
'1061' => 'Drôle. Vous vous donnez quelque chose. Problème?',
'1062' => 'S\'il vous plaît spécifier un montant positif de nuyens.',
'1063' => 'Vous avez seulement %s.', # nuyen
'1064' => 'Ce joueur n\'est pas dans votre parti.',
'1065' => 'Vous pouvez seulement télécommander NPC',
'1066' => 'Seuls les commandes suivantes à distance sont autorisées: %s.', # rawlist
'1067' => 'Vous n\avez pas %s équipé.', # type
'1068' => 'Vous êtes déjà en train d\'explorer %s. ETA: %s.',
'1069' => 'Cet emplacement est inconnu ou ambiguë.',
'1070' => 'Cet emplacement n\'existe pas dans %s.',
'1071' => 'Vous êtes déjà en %s.',
'1072' => 'S\'il vous plaît spécifier une cible de se téléporter.',
# XXX: Translate
'1073' => 'This city is unknown.',
'1074' => 'You cannot cast teleport inside this location.',
'1075' => 'You cannot teleport to %s because %s do(es) not have the min level of %s.',
'1076' => 'You need at least %s level %s to teleport %s party members.',
'1077' => 'You need %s MP to brew this potion, but you got only %s.',
'1078' => 'You cannot cast this spell inside a dungeon.',
'1079' => 'You cannot teleport into dungeons.',
'1080' => 'You cannot move because %s is dead.',
'1081' => 'You cannot move because %s is overloaded.',
'1082' => 'You cannot move because %s has no #aslset.',
'1083' => 'You cannot hunt own party members.',
'1084' => 'You cannot hunt %s because you are in %s and %s is in %s.',
'1085' => 'You cannot join NPC parties.',
'1086' => 'You cannot join your own party.',
'1087' => 'The party does not want you to join.',
'1088' => 'The party has reached the maximum membercount of %d.',
'1089' => 'This player is not in your party.',
'1090' => 'You cannot kick yourself.',
'1091' => '%s is already the party leader.',
'1092' => 'You cannot give leadership to NPCs.',
'1093' => 'You are not in a party.',
'1094' => 'You should not use this command to swap leader position. Please use the #(le)ader command.',
'1095' => 'You are already leader of your party.',
'1096' => 'Your leader does not allow to takeover the leadership.',
'1097' => 'Please wait %s and try again.',
'1098' => 'There is currently no enemy available.',
'1099' => 'You cannot do this when you are in a party.',
'1100' => 'You cannot afford to use the bank. This cost %s and you only have %s to spare.',
'1101' => 'You don`t have that item in your bank.',
'1102' => 'You do not have that much %s in your bank.', # itemname
'1103' => 'You cannot push %s because you only carry %s.', # nuyen, nuyen
'1104' => 'You cannot pop %s, because you only have %s in your bank account.', # nuyen, nuyen
'1105' => 'There are no shops here.',
'1106' => '%s does not have a shop.', # player
'1107' => '%s\'s shop is empty.', # player
'1108' => 'This shop does not offer this item.',
'1109' => 'The minimum price for an item is %s.',
'1110' => 'Your price exceeds the max price.',
'1111' => 'All your bazar slots are in use. Try #pop or #buyslot.',
'1112' => 'You don`t have that item in your bazaar.',
'1113' => 'You do not have that much %s in your bazaar.',
'1114' => 'The fee for popping %d items out of your bazar is %s, but you only have %s.',
'1115' => 'You cannot buy items from your own shop.',
'1116' => 'You tried to purchase %d %s, but the shop only offers %d.',
'1117' => 'Your input exceeds the max length of %d characters.',
'1118' => 'You cannot enter this location.',
'1119' => 'You cannot destroy a clan when it\'s not empty and cleaned.',
'1120' => 'You are already in the "%s" clan.',
'1121' => 'This clan or player is unknown.',
'1122' => 'This clan has reached it\'s member limit of %d.',
'1123' => 'You were already applying for a clan, your old request has been deleted.',
'1124' => 'You do not have the right permissions.',
'1125' => '%s did not request to join your clan.',
'1126' => 'Your clan has reached it\'s limit of %s members. You can purchase more slots via the #manage function.',
'1127' => 'You do not have the minimum level of %s to create a clan.',
'1128' => 'The name of your clan is too long or too short.',
'1129' => 'A clan with this name already exists.',
'1130' => 'Your slogan exceeds the maxlength of %d characters.',
'1131' => 'You want to pop %s(+%s)=%s out of the clan bank, but it currently holds only %s.',
'1132' => 'You try to push another %s into the clan bank, but it already holds %s/%s.',
'1133' => 'You don\'t have that item in your clanbank.',
'1134' => 'You don\'t have that much %s in your clanbank.',
'1135' => 'Somehow the elevator is blocking this floor for you.',
'1136' => 'You push the button but you are on the very same floor already.',
'1137' => 'You don`t need to rest.',
'1138' => 'The doctor says: "You don`t need my help, chummer".',
'1139' => 'The doctor shakes his head: "No, my friend. Healing you will cost %s but you only have %s."',
'1140' => 'There is no such item here.',
'1141' => 'You already have %s implanted.',
'1142' => 'You can not implant %s. It conflicts with %s.',
'1143' => 'You don`t have enough essence(%s) to implant %s, which needs %s essence.',
'1144' => 'The doctor shakes his head: "My friend, removing this from your body will cost %s, but you only have %s."',
'1145' => 'Your character cannot learn %s.',
'1146' => 'You have already learned %s.',
'1147' => 'You need %s to learn this spell.',
'1148' => 'You cannot search again.',
'1149' => 'Your party members tried to crack the lock, but failed.',
'1150' => 'Purchasing items by ID is disabled here, because of possible race conditions.',
'1151' => 'I don`t want your %s.',
'1152' => 'There are no trains planned for today.',
'1153' => 'This target is unknown. Check available targets with #travel.',
'1154' => 'You can not afford %d tickets for %s.',
'1155' => 'This equipment has no special usage. You can equip it with #equip.',
'1156' => 'Your weapon is already loaded.',
'1157' => 'This item works only in combat.',
'1158' => 'You can only craft equipment.',
'1159' => 'You can only break statted items.',
'1160' => 'The second item is not a rune.',
'1161' => 'The rune has mixed mount and equipment modifiers. You have to split it first.',
'1162' => 'This rune can only be applied to mounts.',
'1163' => 'This rune can only be applied to equipment.',
'1164' => 'Please "#mount clean" before you change it.',
'1165' => 'The item string would get too long with another modifier.',
'1166' => 'You can only split runes.',
'1167' => 'This rune has only one modifier.',
'1168' => 'The rune completely broke while splitting it. You don\'t need to pay.',
'1169' => 'You can not reload a melee weapon, can you? Oo',
'1170' => 'Your party is not moving.',
'1171' => 'Your character has been created already. You can type #reset to start over.',
'1172' => 'Your race is unknown or an NPC only race. Valid races: %s.',
'1173' => 'Your gender is unknown. Valid genders: %s.',
'1174' => "The command is not available for your current action or location. Try #c [<l|long>] to see all currently available commands.",
'1175' => 'That\'s more than I offer, chummer.',
'1176' => 'You cannot do suregery on your %s.',
'1177' => 'You are at the minimum %s level of %s for your race.',

########################
# 10000-14999 = Spells #
########################
# Generic
'10000' => '%s utilise le niveau %s %s potion sur %s.',
'10001' => '%s utilise le niveau %s %s sur %s.',
'10002' => '%s utilise le niveau %s %s potion sur %s.',
'10003' => '%s utilise le niveau %s %s sur %s.',
# Berzerk
'10010' => '%s utilise le niveau %s %s potion sur %s, +%s min_dmg / +%s max_dmg pour %s.',
'10011' => '%s jette le niveau %s %s sur %s, +%s min_dmg / +%s max_dmg for %s.',
'10012' => '%s utilise le niveau %s %s potion sur %s.',
'10013' => '%s jette le niveau %s %s sur %s.',
# Blow
'10020' => '%s utilise le niveau %s %s potion sur %s qui a volatilisé %s et est maintenant en position %s.',
'10021' => '%s jette le niveau %s %s sur %s qui a volatilisé %s et est maintenant en position %s.',
'10022' => '%s utilise le niveau %s %s potion sur %s qui a volatilisé %s et est maintenant en position %s.',
'10023' => '%s jette le niveau %s %s sur %s qui a volatilisé %s et est maintenant en position %s.',
# Chameleon
'10030' => '%s utilise le niveau %s %s potion sur %s, +%s charisma pour %s.',
'10031' => '%s jette le niveau %s %s sur %s, +%s charisma pour %s.',
'10032' => '%s utilise le niveau %s %s potion sur %s.',
'10033' => '%s jette le niveau %s %s sur %s.',
# Firebolt
'10040' => '%s utilise le niveau %s %s potion sur %s et a causé %s dommage.',
'10041' => '%s jette le niveau %s %s sur %s et a causé %s dommage.',
'10042' => '%s utilise le niveau %s %s potion sur %s et à causé %s dommage, %s/%s HP perdu.',
'10043' => '%s jette le niveau %s %s sur %s et à causé %s dommage, %s/%s HP perdu.',
# Freeze
'10050' => '%s utilise le niveau %s %s potion sur %s. %s secondes gelés avec la puissance %01f.',
'10051' => '%s jette le niveau %s %s sur %s. %s secondes gelés avec la puissance %01f.',
'10052' => '%s utilise le niveau %s %s potion sur %s. %s secondes gelés avec la puissance %01f.',
'10053' => '%s jette le niveau %s %s sur %s. %s secondes gelés avec la puissance %01f.',
# Goliath
'10060' => '%s utilise le niveau %s %s potion sur %s, +%s force pour %s.',
'10061' => '%s jette le niveau %s %s sur %s, +%s force pour %s.',
'10062' => '%s utilise le niveau %s %s potion sur %s.',
'10063' => '%s jette le niveau %s %s sur %s.',
# Hawkeye
'10070' => '%s utilise le niveau %s %s potion on %s, +%s firearms for %s.',
'10071' => '%s jette le niveau %s %s on %s, +%s firearms for %s.',
'10072' => '%s utilise le niveau %s %s potion on %s.',
'10073' => '%s jette le niveau %s %s on %s.',
# Hummingbird
'10080' => '%s utilise le niveau %s %s potion sur %s, +%s de rapidité pour %s.',
'10081' => '%s jette le niveau %s %s sur %s, +%s de rapidité pour %s.',
'10082' => '%s utilise le niveau %s %s potion sur %s.',
'10083' => '%s jette le niveau %s %s sur %s.',
# Magicarp
'10090' => '%s utilise le niveau %s %s potion sur %s et ils ont perdu %s MP.',
'10091' => '%s jette le niveau %s %s sur %s, +%s et ils ont perdu %s MP.',
'10092' => '%s utilise le niveau %s %s potion sur %s et ils ont perdu %s MP.',
'10093' => '%s jette le niveau %s %s sur %s et ils ont perdu %s MP.',
# Turtle
'10100' => '%s utilise le niveau %s %s potion sur %s, +%s marm/ferme pour %s.',
'10101' => '%s jette le niveau %s %s sur %s, +%s marm/ferme fpour %s.',
'10102' => '%s utilise le niveau %s %s potion sur %s.',
'10103' => '%s jette le niveau %s %s sur %s.',
# XXX: Translate
# Heal
'10110' => '%1$s uses a level %2$s %3$s potion on %4$s, %5$s.',
'10111' => '%1$s casts a level %2$s %3$s on %4$s, %5$s.',
'10112' => '%1$s uses a level %2$s %3$s potion on %4$s.',
'10113' => '%1$s casts a level %2$s %3$s on %4$s.',
# Calm
'10120' => '%1$s uses a level %2$s %3$s potion on %4$s. +%5$sHP for %6$s seconds.',
'10121' => '%1$s casts a level %2$s %3$s on %4$s. +%5$sHP for %6$s seconds.',
'10122' => '%1$s uses a level %2$s %3$s potion on %4$s.',
'10123' => '%1$s casts a level %2$s %3$s on %4$s.',

############################
#   5000-9999   = Messages #
############################
'5000' => '%s vient de quitter son serveur Irc.', # username 
'5001' => 'Vous vous réveillez et avez un délicieux petit déjeuner.',
'5002' => 'Vous êtes prêt à partir.',
'5003' => 'Le parti avance au niveau %s.', # level
'5004' => 'Vos attributs: %s.', # statlist
'5005' => 'Inventaire',
'5006' => 'Vos compétences: %s.', # statlist
'5007' => 'Endroits connus à %s: %s.', # cityname, places
'5008' => 'Votre parti a %s: %s.', # nuyen sum, party sum list
'5009' => 'Stats quête par ville: %s.', # questlist
'5010' => 'Stats quête: %d open, %d accomplished, %d rejected, %d failed, %d unknown from a total of %d.',
'5011' => '%d: %s - %s (%s)', # questid, questname, describtion, status
'5012' => 'Votre asl: %s. Use #asl [<age|bmi|height>] for party sums.',
'5013' => 'Votre parti\'s %s(%s): %s.', # field, total, sumlist
# Gender Race L(LL), HP/HPP MP/MPP, ATK, DEF, DMG-DDMG, MARM/FARM, XP, Karma, NY, WEIGHT/WWEIGHT
# Status with magic
'5014' => "%s %s L%s(%s). {$b}HP{$b}:%s/%s, {$b}MP{$b}:%s/%s, {$b}Atk{$b}:%s, {$b}Def{$b}:%s, {$b}Dmg{$b}:%s-%s, {$b}Arm{$b}(M/F):%s/%s, {$b}XP{$b}:%.02f, {$b}Karma{$b}:%s, {$b}¥{$b}:%.02f, {$b}Weight{$b}:%s/%s.",
# Status without magic
'5015' => "%s %s L%s(%s). {$b}HP{$b}:%s/%s, {$b}Atk{$b}:%s, {$b}Def{$b}:%s, {$b}Dmg{$b}:%s-%s, {$b}Arm{$b}(M/F):%s/%s, {$b}XP{$b}:%.02f, {$b}Karma{$b}:%s, {$b}¥{$b}:%.02f, {$b}Weight{$b}:%s/%s.",
# Party status
'5016' => 'Vous êtes %s', # action
'5017' => 'Vous dirigez %d membres (%s) et vous êtes %s', # membercount, memberlist, action
'5018' => 'Votre parti (%s) est en train de %s', # memberlist, action
'5019' => 'Ancien message: %s', # message
'5020' => 'Vous quittez  %s.', # location
'5021' => 'Vous entendez le son de l\'alarme!',
'5022' => 'Votre tentative de piratage a échoué.',
'5023' => 'Votre demande d\'adhésion a été envoyé aux chefs de clan.',
'5024' => 'Votre cible de détournement (%s) disparu.', # target
'5025' => '%s est parti de %s.', # target, location
'5026' => '%s est dans votre parti maintenant.', # target
'5027' => 'Vous avez exploré %s à nouveau, mais il semble que vous connaissez tous les coins de la ville.', # cityname
'5028' => 'Vous avez exploré %s à nouveau, mais n\'a pas pu trouver quelque chose de nouveau.', # cityname
'5029' => '%s', # location found text
'5030' => '%s', # inngame help message
'5031' => 'Vous avez perdu votre cible et continue dans les rues de %s.', # cityname
'5032' => 'Vous avez trouvé %s à %s avec un parti de %s membres.', # target, location, membercount
'5033' => 'Vous avez trouvé %s dans les rues de %s.', # target, cityname
'5034' => "Vous avez collecté un {$b}bounty{$b}: %s.", # nuyen
'5035' => '%s ont été comptabilisés sur votre compte bancaire pour la vente de %s %s to %s.', # nuyen, amt, item, player
'5036' => 'Votre personnage a été puni %.02f bad_karma.', # bad karma
'5037' => 'Commandes cachées: %s.', # cmdlist
'5038' => 'Joueur %s ne pas appartenir à un clan pour le moment.', # player
'5039' => '%s est dans le clan "%s" avec %s/%s membres, %s/%s richesse et %s/%s à la banque. leur motto: %s',
'5040' => '%d Page membre clan %d/%d: %s.', # membercount, page, npages, sumlist
'5041' => 'Page Historique Clan %d/%d: %s.', # page, npages, weird msglist
'5042' => 'Cmds: %s.',
'5043' => '%s', # Compare table messages, 3 rows
'5044' => '%s', # Unknown table messages, multiple rows
'5045' => 'Votre cyberguerre: %s.', # itemlist
'5046' => 'Vous avez sûrement oublié %s "%s".', # section, knowledge
'5047' => 'Vos effets: %s.', # effectlist
'5048' => 'Votre équipement: %s.', # equipstring
'5049' => '%s', # examine string
'5050' => 'Votre parti HP: %s.', # HP/MP string
'5051' => 'Votre parti MP: %s.', # HP/MP string
'5052' => 'Votre parti a %s karma: %s.', # total, sumlist
'5053' => 'Votre connaissance: %s.', # statlist
'5054' => 'Sorts connus: %s.', # spellfmtlist
'5055' => 'Mots connus: %s.', # #rawitemlist
'5056' => 'Votre a le niveau %s(%s/%s): %s.', # total level, xp , need xp, sumlist
'5057' => 'Talents à mettre à niveau: %s.', # lvlupstring
'5058' => 'Attributs à mettre à niveau: %s.', # lvlupstring
'5059' => 'Connaissances à mettre à niveau: %s.', # lvlupstring
'5060' => 'Sorts à mettre à niveau: %s.', # lvlupstring
'5061' => 'Vous avez utilisé %d karma et augmenté votre niveau de %s de %d à %d.', # karma, field, from, to
'5062' => "{$b}%s{$b} vous montre: %s.", # player, examinestring
'5063' => 'Articles %s et %s ont été échangés.', # itemname, itemname
'5064' => 'Votre parti porte %s: %s.', # total weight, sumlist
'5065' => 'Votre parti n\'accepter plus de nouveaux membres.',
'5066' => 'Votre parti  accepte de nouveaux membres.',
'5067' => '%s a été banni du parti.',
'5068' => '%s peut maintenant se joindre à votre parti à nouveau.',
'5069' => '%s quêtes, page %d/%d: %s.',
'5070' => '%s a déjà été %s.', # option, en/disabled
'5071' => '%s a déjà été %s pour votre personnage.', # option, en/disabled
'5072' => 'Votre type de message Shadowlamb a déjà été fixé à %s.', # notice|privmsg
'5073' => 'Votre type de message Shadowlamb a été fixé à %s.', # notice|privmsg
'5074' => 'Ceci est un test.',
'5075' => 'vous êtes déjà en train de jouer en mode fonctionnement. sympa!',
'5076' => 'Tapez "#rm %s" pour confirmer.',
'5077' => 'vous êtes en train de jouer en mode fonctionnement. Cela signifie stats illimités, mais une mort instantanée. Bonne chance!',
'5078' => 'Il est conseillé d\'activer #enable norl maintenant aussi, pour éviter que votre char soit enlevé avec la commande #rl command!',
'5079' => 'Votre page de monture %s/%s: %s.', # page, pages, itemlist
'5080' => 'Vous avez stocké %d de votre %s dans votre %s.', # amt, itemname, mountname
'5081' => 'Vous avez recueilli %d %s de votre %s et mis cela dans votre inventaire (ID: %d).', # amt, itemname, mountname, invid
'5082' => 'Vous avez nettoyé votre monture.',
'5083' => 'Montures du Parti(%s/%s): %s.', # storage, max storage, sumlist
'5084' => "{$b}%s{$b} pm: \"%s\"", # player, message
'5085' => "{$b}%s{$b} dit: \"%s\"", # player, message
'5086' => "{$b}%s{$b} chuchote: \"%s\"", # player, message
'5087' => '%s', # bounties
'5088' => '%s', # own bounty
'5089' => '%s', # other bounty
'5090' => '%s bouge %.01f mètres %s et est maintenant à la position %.01f mètres%s', # player, fw/bw, metres, busy (OWN)
'5091' => '%s bouge %.01f mètres %s et est maintenant à la position %.01f mètres%s', # player, fw/bw, metres, busy (ENEMY)
'5092' => 'Le parti ennemi a dit "Au revoir".',
'5093' => 'Vous continuez %s.', # action
'5094' => '%s vous remercie et quitte le parti.', # player
'5095' => 'Vous affrontez %s.',
'5096' => 'You rencontrez %s.%s%s',
'5097' => '%s se déplace %.01f de quelques mètres en direction de %s et est maintenant situé à %.01f mètres. %ds occupé.',
'5098' => '%s se déplace %.01f de quelques mètres en direction d %s et est maintenant situé à %.01f mètres.',
'5105' => 'Vous récupérez %s et %s XP.', # nuyen, XP
'5110' => 'Vous êtes sur le point de jeter %d %s. retapez pour confirmer.', # amt itemname
'5111' => 'Vous vous débarrassé de %d %s.',
'5112' => '%s essaye de fuir du combat. %s busy.', #player, duration
'5113' => '%s a fui l\'ennemi.', # player
'5114' => '%s  a fui le combat.', # player
'5115' => 'Vous avez donné %d %s à %s.%s', # amt, item, player, busytime
'5116' => '%s reçu %s de %s.', # player, itemlist, source
'5117' => '%s a parlé à %s au sujet de %s.', # player, player, knowledge
'5118' => 'Vous avez reçu %s de %s.',
'5119' => 'Vous avez donné %s à %s.',
'5120' => 'Vous ne voyez aucun des autres joueurs.',
'5121' => 'Vous voyez ces joueurs: %s.',
'5122' => 'Votre distance de combat par défaut a été fixé à %.01f meters.',
'5123' => 'Distances: %s.', # sumlist
'5124' => 'Distances: %s.', # sumlist
'5125' => 'Vous obtenez une récompense de %s for killing the enemy.',
'5126' => 'Vous commencez à explorer %s. ETA: %s.',
'5127' => 'Vous allez à %s. ETA: %s.',
'5128' => 'Vous ne voyez aucune des autres montures des joueurs à voler.',
'5129' => '%s', # Mount page
'5130' => 'Montures de détourner: %s.',
# XXX: Translate
'5133' => '%s used %s MP to cast %s and your party is now outside of %s.', # player, mp, teleportspellname, location 
'5134' => 'You start to hunt %s. ETA: %s.', # player, duration
'5135' => '%s left the party.', # player
'5136' => '%s joined the party.', # player
'5137' => '%s has been kicked off the party.', # player
'5138' => '%s is the new party leader.', # player
'5139' => "Your party has set it's loot mode to: {$b}%s{$b}.", # lootmode
'5140' => '%s and %s have swapped their party position.', # player, player
'5141' => 'You are guided into the arena and see your enemy: %s.', # snippet
'5142' => '%s', # generic bank viewi.
'5143' => 'You pay %s nuyen.', # nuyen
'5144' => 'You put %d of your %s into your bank account. You now carry %s/%s.', # amount, item, weight, maxweight
'5145' => 'You remove %d %s from your bank account and put it into your inventory. You now carry %s/%s.', # amount, item, weight, maxweight
'5146' => 'You carry %s. In your bank are %s. Every transaction costs %s.', # nuyen, nuyen. cost
'5147' => 'You push %s into your bank account (now %s) and keep %s in your inventory.', # nuyen, nuyen, nuyen
'5148' => 'You pop %s from your bank account (%s left) and now carry %s.', # nuyen, nuyen, nuyen
'5149' => 'Shops, page %d/%d: %s.',
'5150' => '%s\'s shop: "%s"', # player, bazar slogan
'5151' => '%d items: %s.', # # itemcount, bazaritemlist
'5152' => "%s sells one of %d %s for {$b}%s{$b}. Type {$b}#buy %1\$s %3\$s{$b} to purchase.", # player, itemcount, itemname, nuyen, examinestring
'5153' => 'You now offer %d %s for %s each in your bazar.', # amount, itemname, price
'5154' => 'You pay the fee of %s and remove %d %s from your bazar and put it into your inventory.', # price, amount, itemname
'5155' => 'You attempt to purchase %d %s from %s for %s. Retype to confirm.', # amount, itemname, player, price
'5156' => '%s purchased %d %s from %s\'s bazar.', # player, amount, itemname, player
'5157' => 'You currently have %d of %d bazar slots in use. Another slot would cost you %s. Type "#buyslot yesplease" to confirm.',
'5158' => 'You pay the fee of %s and now have %s bazar slots.', # nuyen, slotcount
'5159' => 'Your slogan has been set to: "%s".', # slogan
'5160' => 'Bazaar matches, page %d/%d: %s.', # page, npages, bazaar searchlist
'5161' => 'You want to purchase %d %s, but you can only find %d.', # amount, itemname, amount
'5162' => 'You want to pay %s for %d %s, but the best price is %s.', # price, amount, itemname, price
'5163' => 'You are about to buy %d %s for %s in total. Retype your command to confirm.', # amount, itemname, price
'5164' => 'You purchased %d %s for a total price of %s.',
'5165' => 'You have left the "%s" clan.',
'5166' => '%s has accepted your join request for the %s clan.',
'5167' => 'Clan join requests page %d/%d: %s.',
'5168' => 'Congratulations. You formed a new clan named "%s".',
'5169' => 'You paid the fee of %s and set a new slogan for your clan.',
'5170' => 'Your clan currently can bank %s. Another %s would cost you %s. Please type "%s" to confirm.',
'5171' => 'Your clan has already reached the maximum of %s/%s.',
'5172' => 'You paid %s and your clan can now hold %s/%s.',
'5173' => 'You pay the fee of %s and push %s to the clan bank, which now holds %s/%s.',
'5174' => 'You pay the fee of %s and pop %s out of the clan bank, which now holds %s/%s.',
'5175' => 'Your clan\'s %s option has been %s.',
'5176' => 'ClanBank, page %d/%d: %s.',
'5177' => 'Your party pushes the "%s" button and the elevator starts to move.',
'5178' => 'You are on %s floor %s. Accessible floors: %s.',
'5179' => 'The doctor takes your %s and heals you.',
'5180' => 'You paid %s and got %s implanted.',
'5181' => 'You pay %s and got your %s removed.',
'5182' => "The party goes to sleep. You go to your {$b}own{$b} bedroom.",
'5183' => 'Available Courses: %s.',
'5184' => 'You pay %s and learned %s.',
'5185' => 'You search the %s...',
'5186' => 'You search the %s but find nothing.',
'5187' => '%s cracked the lock!',
'5188' => '%s', # Store item list fmt_sumlist
'5189' => '%s', # Store item examine string
'5190' => 'You paid %s and bought %s. Inventory ID: %d.', # nuyen, itemname, invid
'5191' => 'You sold %d of your %s for %s. You now carry %s/%s.', # amount, itemname, nuyen, weight, maxweight
'5192' => 'You attempt to steal %s...', # itemname
'5193' => 'You were lucky and able to steal %s.',
'5194' => 'You cannot find the right moment to steal something.',
'5195' => 'You are out of luck ... the shop owner silently called the cops and you are put into Delaware Prison.',
'5196' => 'You are out of luck ... the shop owner silently called the cops ...',
'5197' => 'The shop owner is watching ... you better wait a bit.',
'5198' => 'The salesman smiles and puts the item in the shop window.',
'5199' => 'Trains: %s.', # target fmt_sumlist
'5200' => '%s paid the price of %s and you take the next train to %s. ETA: %s.', # player, nuyen, target, eta
'5201' => '%s consumed an item: %s. %s seconds busy.', # player, itemname, busytime
'5202' => 'Possible targets: %s.', # Computer target list fmt_rawitems.
'5203' => 'You put your %s into the inventory, %s seconds busy.', # itemname, busytime
'5204' => 'You use %s from now on, %d seconds busy.', # itemname, busytime
'5205' => 'You are out of ammo!',
'5206' => '%s loads %d bullet(s) into his %s. %s seconds busy.', # player, amount, itemname, busytime
'5207' => 'You load %d bullet(s) into your %s.', # amount, itemname
'5208' => 'You pay %s and the smith cleans the %s from all it\'s runes. You receive a(n): %s.', # price, itemname, itemname
'5209' => 'You pay %s and break the %s into %s.', # price, itemname, rawlist
'5210' => 'You pay %s but breaking the %s into runes failed.', # price, itemname
'5211' => 'The smith examines your items ... "It would cost you %s to upgrade your %s with %s. The fail chance is %.02f%% and the break chance is %.02f%%. Please retype to confirm.',
'5212' => 'The smith takes your items and goes to work...',
'5213' => 'The upgrade horrible failed and the item and the rune is lost. The smith is very sorry and you don`t need to pay any money.',
'5214' => 'The upgrade failed and the rune is lost. You only need to pay %s for the work.',
'5215' => 'The upgrade succeeded. You pay %s and the smith presents you a fine %s.',
'5216' => 'It would cost %s to split the %s. Retype your command to confirm.',
'5217' => 'You pay %s and split your %s into %s.',
'5218' => 'You start to to crack the lock on %s\'s %s. Time penalty: %s.',
'5219' => '%s is trying to \X02crack the LOCK\X02 on your %s!',
'5220' => 'You failed to crack the lock on %s\'s %s.',
'5221' => 'You are done with cracking your target\'s lock.',
'5222' => '"Hey, what are you doing!!!" ... You spot a police officer approaching!',
'5223' => 'You managed to crack the lock on %s\'s %s but it seems empty.',
'5224' => 'You managed to crack the lock on %s\'s',
'5225' => '%s managed to crack your lock on your %s!',
'5226' => 'In the last second you see military forces approaching and decide to interrupt your activities.',
'5227' => '%s stole %dx%s out of your %s.',
'5228' => '%s used %s on %s. %s%s', # player, itemname, player, busy, appendmsg # (friend)
'5229' => '%s used %s on %s. %s', # player, itemname, player, appendmsg # (foe)
'5230' => '%s attacks %s with %s but misses. %s seconds busy.',
'5231' => '%s attacks %s with %s but caused no damage. %s seconds busy.',
'5232' => '%1$s attacks %2$s with %3$s and caused %6$s%4$s damage%6$s. %5$s seconds busy.',
'5233' => '%1$s attacks %2$s with %3$s and caused %8$s%4$s damage%8$s, %5$s/%6$sHP left. %7$s seconds busy.',
'5234' => '%1$s attacks %2$s with %3$s and killed them with %8$s%4$s damage%8$s, %5$s seconds busy. You loot %6$s and %7$sXP.',
'5235' => '%1$s attacks %2$s with %3$s and killed them with %6$s%4$s damage%6$s, %5$s seconds busy.',
'5236' => 'You got a new quest: %s.',
'5237' => 'You declined the "%s" quest, forever.',
'5238' => 'You have completed a quest: %s.',
'5239' => 'You hand %d %s(s) to %s.',
'5240' => 'You received %s.', # quest reward string
'5241' => 'In Shadowlamb v3 there are: %s different NPC in %s Areas with %s Locations. %s Items, %s Spells and %s Quests. Try #stats to show how many are playing.',
'5242' => 'The party stopped. What now?!',
'5243' => 'It is the year 2064 + %s.',
'5244' => 'Currently there are %s Human, %s NPC and %s parties in memory.',
'5245' => 'Your character has been deleted. You may issue "#start" again.',
'5246' => 'This will completely delete your character. Type "#reset i_am_sure" to confirm.',
'5247' => 'Active players, page %d of %d: %s.', # page, nPages, rawlist
'5248' => 'Active parties, page %s of %s: %s.', # page, nPages, rawlist
'5249' => 'Message of the day: %s', # file content
'5250' => 'You know a new %s: %s.', # knowledge, what, field
'5251' => "You now have {$b}%d(+%d) karma{$b}. With karma you can #lvlup.", # karma, karmagain
'5252' => 'You respawn at %s.', # location
'5253' => 'You lost %s XP!', # xp
'5254' => 'You lost %s!', # nuyen
'5255' => 'You lost %d of your %s.',
'5256' => 'You played #running_mode and got killed by an NPC or other #rm player. You are dead. Use #reset to start over.',
'5257' => '%s', # Arrive city message.
'5258' => '%s', # clan message
'5259' => 'Trains: %s.', # Travel target list fmt_sumlist.
'5260' => 'You gained +%s MP (%s/%s).', # From orcas effect
'5261' => 'You gained +%s HP (%s/%s).', # From elpehants effect
'5262' => 'Possible surgery: %s.', # Some prices fmt_sumlist.
'5263' => 'You paid %s and got your %s changed to %s. You lost %s essence while getting %s karma back.', # price, field, value, essence, karma
);
?>