# SmartbeesTask
SmartbeesTask

Wymagania

Wymagania, które są potrzebne do uruchomienia Twojej aplikacji:

    PHP 7.3 lub wyższe
    MySQL
    Inne zależności, np. biblioteki wymagane przez Composer itp.

Instalacja

    Sklonuj repozytorium na swoje urządzenie.
    Wykonaj komendę composer install, aby zainstalować wszystkie zależności.
    Skonfiguruj plik .env zgodnie z danymi Twojej bazy danych i innych ustawień.
    Uruchom migracje, aby utworzyć potrzebne tabele w bazie danych: php bin/console doctrine:migrations:migrate.
    Uruchom serwer deweloperski: php bin/console server:run.
    
Kod tej aplikacji został napisany w języku PHP w oparciu o framework Symfony 5.4. Jest to aplikacja do obsługi zamówień online, która umożliwia użytkownikom składanie zamówień, wybieranie różnych opcji dostawy i płatności, oraz korzystanie z kodów rabatowych.

Aplikacja składa się z kilku głównych kontrolerów, które zarządzają różnymi funkcjonalnościami. Dane są przechowywane w bazie danych MySQL, a dostęp do nich jest realizowany przez różne serwisy, które zarządzają logiką biznesową.

W kodzie zastosowano dobre praktyki pisania kodu, takie jak zastosowanie SOLID, DRY, i innych zasad projektowania obiektowego.
