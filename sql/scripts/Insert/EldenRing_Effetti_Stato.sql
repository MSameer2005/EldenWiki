use eldenring;

INSERT INTO EffettiStato (nome, descrizione, icona, mitigato_da, curato_da, statistica_resistente, note)
VALUES ("Sanguinamento", "Causa danni nel tempo.", "../img/EffettiStato/Sanguinamento.jpg",
        "Invigorating Cured Meat, Stalwart Horn Charm", "Stanching Boluses, Bestial Constitution", "Robustness",
        "L'effetto si accumula nel tempo."),
       ("Assideramento", "Riduce la velocità e infligge danni da freddo.", "../img/EffettiStato/Assideramento.jpg",
        "Invigorating Cured Meat, Stalwart Horn Charm", "Bestial Constitution, Thawfrost Boluses", "Robustness", ""),
       ("Sonno", "Mette il bersaglio a dormire.", "../img/EffettiStato/Sonno.jpg",
        "Clarifying Cured Meat, Clarifying Horn Charm", "Stimulating Boluses, Lucidity", "Focus",
        "Può essere interrotto da danni."),
       ("Follia", "Causa perdita di punti FP e danni alla mente.", "../img/EffettiStato/Follia.jpg",
        "Clarifying Cured Meat, Clarifying Horn Charm", "Clarifying Boluses, Lucidity", "Focus",
        "Influenza della Fiamma Frenzata."),
       ("Morbo Mortale", "Causa la morte istantanea", "../img/EffettiStato/MorboMortale.jpg",
        "Prince of Death's Pustule, Prince of Death's Cyst", "Rejuvenating Boluses, Order Healing, Law of Regression",
        "Vitality", "Solo su esseri umanoidi"),
       ("Avvelenamento", "Infligge danni nel tempo e può causare altri effetti negativi.",
        "../img/EffettiStato/Veleno.jpg", "Antidote, Purifying Herbs", "Healing Potions, Detoxification",
        "Constitution", ""),
       ("Marcescenza Scarlatta", "Causa deterioramento fisico nel tempo.",
        "../img/EffettiStato/MarcescenzaScarlatta.jpg", "Restoration Potions, Healing Spells", "N/A", "Constitution",
        "Effetto permanente se non curato.");
