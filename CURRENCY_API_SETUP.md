# Configuration de l'API de Currency

## Variables d'environnement à ajouter dans votre fichier .env

```env
# Currency Exchange API Configuration
EXCHANGERATE_API_KEY=your_api_key_here
EXCHANGERATE_BASE_URL=https://api.exchangerate-api.com/v4/latest/
EXCHANGERATE_CACHE_DURATION=3600
```

## Configuration de l'API ExchangeRate

1. **Inscription gratuite** : Rendez-vous sur [ExchangeRate-API](https://www.exchangerate-api.com/)
2. **Obtenir une clé API** : Créez un compte et obtenez votre clé API gratuite
3. **Limites gratuites** : 
   - 1,500 requêtes par mois
   - Taux de change mis à jour quotidiennement
   - Support de 160+ devises

## Utilisation

### Commandes Artisan disponibles

```bash
# Mettre à jour les taux de change
php artisan currency:update-rates

# Forcer la mise à jour (ignorer le cache)
php artisan currency:update-rates --force
```

### Accès dans le dashboard admin

- **URL** : `/admin/currency`
- **Sidebar** : Icône "Taux de Change" dans le menu admin
- **Fonctionnalités** :
  - Affichage des taux en temps réel
  - Convertisseur de devises interactif
  - Actualisation manuelle des taux
  - Historique des conversions

### Intégration automatique

Le système utilise automatiquement les taux de change en temps réel pour :
- Conversion des donations vers TND
- Affichage des statistiques
- Calculs de progression des wallets

En cas d'échec de l'API, le système utilise des taux de secours pour assurer la continuité du service.
