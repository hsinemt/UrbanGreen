# Configuration Twilio pour UrbanGreen

## Étapes de configuration

### 1. Créer un compte Twilio
1. Allez sur [twilio.com](https://www.twilio.com)
2. Créez un compte gratuit
3. Vérifiez votre numéro de téléphone

### 2. Obtenir les credentials
1. Dans votre console Twilio, allez dans "Account" > "API Keys & Tokens"
2. Copiez votre "Account SID" et "Auth Token"
3. Dans "Phone Numbers" > "Manage" > "Active numbers", copiez votre numéro Twilio

### 3. Configuration des variables d'environnement
Ajoutez ces variables à votre fichier `.env` :

```env
# Configuration Twilio
TWILIO_SID=ACbc50b0e1a502ed182a6dcea17a458345
TWILIO_TOKEN=769af803fbba8970aebfe04525729a95
TWILIO_FROM=+13158093819

```
### 4. Test de la configuration
Une fois configuré, la fonctionnalité de booking demandera automatiquement le numéro de téléphone et enverra un SMS de confirmation.

## Format des numéros de téléphone
- **Format tunisien** : `+21612345678` ou `12345678` (sera automatiquement converti)
- **Format français** : `+33123456789` ou `0123456789` (sera automatiquement converti)
- Le système détecte automatiquement le pays basé sur la longueur du numéro

## Messages SMS
Le message de confirmation inclut :
- Nom de l'espace vert réservé
- Localisation
- Message de remerciement pour l'engagement environnemental

## Dépannage
Si vous obtenez l'erreur "Unexpected token '<', "<!DOCTYPE "... is not valid JSON" :
1. Vérifiez que les variables Twilio sont correctement configurées dans `.env`
2. Redémarrez le serveur Laravel
3. Vérifiez les logs dans `storage/logs/laravel.log`
