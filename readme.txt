=== This page needs files ===
Contributors: Jacquemin Serge 
Tags: Stylesheet, CSS, Javascript, JS, Specific, External, File, Page, Post
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1
License: Apache License, Version 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Allow to include urls to javascript and css files inside the HTML header on a page/post specifc basis.

== Screenshots ==

1. When you have some page/post specific files...
2. ...they are easy to include on your page/post.

== Description ==

**Requirements**

PHP 5.3.0 (and above), SPL Types (PECL)

**Features**

EN| Easy to use.
EN| Flexibility for declaring relative/absolute url.
EN| Possibility to give the link/script an ID you could use in javascript.
EN| Possibility to control the ordering of links/scripts.

FR| Facile d'utilisation.
FR| Flexibilit� pour d�clarer une url relative/absolue.
FR| Possibilit� de donner au lien/script un ID que vous pourriez exploiter en javascript.
FR| Possibilit� de contr�ler l'ordre des liens/scripts.

**Roadmap**

Unless a bug gets reported or I think it's lacking a feature, I don't plan to change it anytime soon.

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

**Q.** FR| Version fran�aise ?

**R.** FR| Plus bas sur cette meme page.

**Q.** En| Why Use It?

**A.** EN| Because some of your javascript/css could only be meaningful for one or a few pages and you don't want to either put it in some website-wide file or either inline it.

**Q.** EN| Shouldn't we keep the number of files as little as possible?

**A.** EN| As a rule of thumb, yes, you should. But as your website and savviness grow large you might figure when it's time to heighten the number of files.

**Q.** EN| What are the system requirements I should be aware of?

**A.** EN| PHP 5.3.0 (and above), SPL Types (PECL), Wordpress Theme which fires "wp_footer", HTML5-able browser (for backend), ECMASript enabled (no javascript, no sugar), jQuery (Reminder: Wordpress "comes" with it).

**Q.** EN| "wp_footer"?

**A.** EN| Most Wordpress theme fires it. http://codex.Wordpress.org/Plugin_API/Action_Reference/wp_footer.

**Q.** EN| How do I use it?

**A.** EN| While editing a page/post, go to the "this page needs files" section and add any URL to it.

**Q.** EN| I can't find the section, where is it?

**A.** EN| It's there. Make sure (in "Screen option") you don't have it hidden.

**Q.** EN| Why can't I find the corresponding option in "Screen option"?

**A.** EN| You might have forget to activate the plugin after you have installed it

**Q.** EN| Why do I only see one entry to input a url?

**A.** EN| Because more entries will shows up as you fill in the url

**Q.** EN| How to control in which order my url are rendered?

**A.** EN| You may set a (negative or positive) value to any url's priority. These url will be rendered in their priority ascending order. The lowest the priority is, the higher it will be rendered on the document.

**Q.** EN| What are the boundaries of priority value?

**A.** EN| The boundaries are [-1000, +1000], [TOP - 1000, TOP + 1000], [BOTTOM - 1000, BOTTOM + 1000]

**Q.** EN| What are TOP / BOTTOM?

**A.** EN| Special (case insensitive) keywords you can use in the priority value. TOP will put styles/script on top of the head. BOTTOM will put styles/script at the bottom of the head.

**Q.** EN| Can I combine a value and TOP/BOTTOM?

**A.** EN| Yes, you can set a priority value of "TOP - 1000", "TOP + 55", "BOTTOM - 2", etc. as long as you stay in the boundaries. "B" and "T" are (case insensitive) shorthands for "BOTTOM" and TOP".

**Q.** EN| Where will be rendered my url where no prority have been set?

**A.** EN| When no priority has been set for a url, 0 will be used as priority value.

**Q.** EN| The whole ordering thing doesn't work?!

**A.** EN| Due to how styles/scripts are enqueued using Wordpress, some ordering "magic" had to be done using jQuery. Don't rely of the page source to figure the actual ordering. If there's an issue, check you don't have any javascript error on your page.

**Q.** EN| Why isn't my javascript/css exactly on top/bottom of the head?

**A.** EN| Some other plugin/script must be interfering. This plugin isn't the only player in the game but it will try its best.

**Q.** EN| Can I put javascript/css somewhere else than in the head?

**A.** EN| No, sorry, you can't. There are too many variables to doing that right.

**Q.** EN| Who let the dogs out?!

**A.** EN| Nobody asked that for ages. And the joke is past due.

**Q.** EN| Is this the last English entry of this FAQ?!

**A.** EN| Yes, it is.

**Q.** FR| Pourquoi l'utiliser?

**R.** FR| Parce qu'une partie de votre javascript/css pourrait n'etre pertinent que pour une ou quelques pages et vous ne voulez ni tout inclure dans un fichier portant sur tout le site, ni le mettre en inline.

**Q.** FR| Ne devrions-nous pas garder le nombre de fichiers aussi petit que possible ?

**R.** FR| En regle g�n�ral, en effet. Mais lorsque votre site et votre exp�rience grandit, vous pourquoi cerner quand il est temps d'augmenter le nombre de fichiers.

**Q.** FR| Quelles sont les sp�cifications systeme que je devrais conna�tre ?

**R.** FR| PHP 5.3.0 (et plus), SPL Types (PECL), Theme Wordpress qui d�clenche "wp_footer", navigateur supportant HTML5 (pour le backend), ECMASript activ� (pas de javascript, pas de chocolat), jQuery (Rappel: Wordpress l'inclut).

**Q.** EN| "wp_footer" ?

**R.** EN| La plupart des themes Wordpress le d�clenche. http://codex.Wordpress.org/Plugin_API/Action_Reference/wp_footer.

**Q.** FR| Comment l'utiliser ?

**R.** FR| Lorsque vous �ditez une page/post, allez dans la section "this page needs files" et rajouter-y des URL.

**Q.** FR| Je ne trouve pas la section, ou est-elle ?

**R.** FR| Elle est la. Assurez-vous que vous ne l'avez pas cach�e (dans "Screen option").

**Q.** FR| Je ne trouve pas l'option correspondante dans "Screen option" ?

**R.** FR| Vous pourriez avoir oubli� d'activ� le plugin apres l'avoir install�.

**Q.** FR| Pourquoi ne vois-je qu'une seule entr�e pour introduire une url ?

**R.** FR| Parce que d'autres entr�es apparaitrons tandis que vous introduisez votre url.

**Q.** FR| Comment g�rer l'ordre dans lequel sont inclus les urls ?

**R.** FR| Vous pouvez donner une valeur (n�gative ou positive) aux priorit� des url. Les urls seront incluses dans l'ordre croissant de leur priorit�. Au plus bas est la priorit�, au plus t�t appara�t l'url sur le document.

**Q.** FR| Quelles sont les limites des valeurs des priorit�s ?

**R.** FR| Les limites sont [-1000, +1000], [TOP - 1000, TOP + 1000], [BOTTOM - 1000, BOTTOM + 1000]

**Q.** FR| Que sont TOP / BOTTOM ?

**R.** FR| Des mots cl�s (insensibles a la case) que vous pouvez utiliser dans les valeurs des priorit�. TOP mettra les styles/script au sommet du head. BOTTOM mettra les styles/script au planch� du head.

**Q.** FR| Puis-je combiner valeur et TOP/BOTTOM ?

**R.** FR| Oui, vous pouvez utiliser une valeur de "TOP - 1000", "TOP + 55", "BOTTOM - 2", etc. tant que vous respectez les limites. "B" et "T" sont des raccourcit (insensibles a la case) pour "BOTTOM" et TOP".

**Q.** FR| Ou seront plac�es mes urls sans priorit� d�finie ?

**R.** FR| Quand il n'y a pas de priorit� d�finie, 0 est consid�r� comme valeur.

**Q.** FR| L'ordre ne fonctionne pas ?!

**R.** FR| Du a la fa�on dont les styles/scripts sont agenc�s par Wordpress, quelques "bricolage" doivent etre fait via jQuery. Ne vous fiez pas a la source d'une page pour v�rifier l'ordre. S'il y a un probleme, v�rifiez qu'il n'y a pas d'erreur javascript sur votre page.

**Q.** EN| Pourquoi mon javascript/css n'est pas exactement au sommet/au planch� du head?

**R.** EN| Certains autres plugins/scripts doivent interf�rer. Ce plugin n'est pas le seul intervenant dans la partie mais il fera de son mieux.

**Q.** EN| Puis-je mettre du javascript/css ailleurs que dans le head ?

**R.** EN| Non, d�sol�. Il y a trop de variables pour faire cela correctement.

**Q.** FR| Qui a vol� l'orange ?!

**R.** FR| Cette vielle blague n'a plus aucun int�ret.

**Q.** FR| Est-ce la derniere ligne en fran�ais de cette FAQ ?!

**R.** FR| Oui.

== Changelog ==

v1.0.0

- Initial release.


http://i.imgur.com/XJeQFxP.jpg
http://i.imgur.com/IrHYoHo.jpg