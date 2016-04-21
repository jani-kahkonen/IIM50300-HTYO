# IIO11100-HTYO

## 1. Käyttötarkoitus
Käytettävyydeltään yksinkertainen verkkokauppa, jonka avulla käyttäjät voivat selata ja tilata "kuvitteellisia" tuotteita, kuten tyypillisesti verkkokaupoissa. Sovelluksen käyttö edellyttää rekisteröitymistä koska sovellukseen täytyy kirjautua. Sovelluksen ideana on olla sopiva mahdollisimman moneen erilaiseen käyttötarkoitukseen. Tarkoituksena oli ottaa mahdollisimman vähän kantaa siihen, millaista tietoa tietokantoihin tallennetaan.
Demo: http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/login.php.

## 2. Käyttöliittymä
![](http://student.labranet.jamk.fi/~H9575/IIO11300/kuvat/kayttoliittyma.jpg)

Sovelluksen ensimmäinen luonnos käyttöliittymästä. Tehty suunnittelu vaiheessa, joten ei pidä täysin paikkaansa.

## 3. Käyttötapauskaavio
![](http://student.labranet.jamk.fi/~H9575/IIO11300/kuvat/UseCase.png)

Karkea sovelluksen käyttötapauskaavio. Tehty suunnittelu vaiheessa, joten ei pidä täysin paikkaansa.

## 4. Käsitemalli
![](http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/documents/domainModel.png)

Käsitemallissa on kuvattu sovelluksen keskeisimmät toiminnallisuudet ja käsitteiden väliset riippuvuudet.

## 5. Luokkamalli
![](http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/documents/classDiagram.png)

Luokkamallit sovelluksen kaikista luokista sekä niiden metodit ja propertyt.

## 6. Sekvenssikaavio
![](http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/documents/sequence.png)

Sekvenssikaaviossa kuvattu sovellukseen rekisteröityminen ja kirjautuminen sekä tarvittavat käyttäjätilin olemassaolon tarkistukset. (isAccountExist)
## 7. Projektisuunnitelma

### 7.1 Työnjako
Yksin.

### 7.2 Vastuut
PHP, MySQL, HTML, CSS ja suunnittelu.

### 7.3 Aikataulu

| VKO | Aika | Tehtävä |
|:----:|:----:|:----:|
| 13 | 5 h | Suunnitelma |
| 14 | 10 h | Tietokannat |
| 15 | 20 h | Tietokannat, logiikka ja käyttöliittymä |
| 16 | 25 h | Logiikka ja käyttöliittymä |

## 8. Tietokannat
![](http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/documents/er-model.png)

Taulujen luonti sekä tiedon lisääminen: http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/tables.sql

## 9. Arkkitehtuuri
![](http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/documents/architecture.png)

Sovelluksessa pyritty 3-kerros arkkitehtuurin tyyppiseen rakenteeseen.