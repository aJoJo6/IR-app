<?php

return [
    'criteria' => [
        'General-purpose enabling technology (GPT-like)',
        'Economy-wide diffusion beyond one sector',
        'Reorganisation of production systems',
        'Labour transformation (skills, control, polarisation)',
        'Governance / institutional response',
        'Evidence of systemic impact over time',
    ],

    'ir4' => [
        'Partial', // GPT-like
        'Partial', // diffusion
        'Meets',   // production
        'Meets',   // labour
        'Partial', // governance
        'Partial', // systemic impact
    ],

    'ir5' => [
        'Unclear', // GPT-like
        'Unclear', // diffusion
        'Partial', // production
        'Partial', // labour
        'Partial', // governance
        'Unclear', // systemic impact
    ],

    'explanations' => [
        'ir4' => [
            'Built on digital technologies (AI, IoT, CPS) but not a distinct new GPT comparable to steam or electricity.',
            'Adoption is widespread but uneven across sectors and organisations.',
            'Introduces integrated, data-driven and autonomous production systems.',
            'Shifts labour toward supervision, data analysis and hybrid technical roles.',
            'Has triggered policy responses (data protection, AI regulation), but frameworks remain fragmented.',
            'Evidence of transformation exists, but productivity gains remain delayed and incomplete.',
        ],

        'ir5' => [
            'Does not introduce new core technologies; relies on IR4.0 infrastructure.',
            'Limited evidence of widespread industrial adoption.',
            'Extends IR4.0 systems toward human-centric and sustainable production.',
            'Emphasises augmentation and interdisciplinary skills rather than clear structural change.',
            'Policy discourse emerging, but institutional frameworks are still evolving.',
            'Too early to determine measurable economic or systemic impact.',
        ],
    ],

    'legend' => [
        'Meets' => 'Strong evidence aligns with historically derived criteria.',
        'Partial' => 'Some evidence, but uneven diffusion or contested interpretation.',
        'Unclear' => 'Too early to judge or insufficient evidence available.',
    ],
];