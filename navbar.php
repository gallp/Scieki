<b> Witaj, <?php echo htmlspecialchars($_SESSION["username"]);?> </b>
 
 <header class="header-main">
     <section class="first-header-section"></section>
 
     <section class="second-header-section">
        
         <a href="raport.php" class="btn btn-warning">Raporty</a>
         <a href="sciekin.php" class="btn btn-warning">Ścieki nieoczyszczone</a>
         <a href="sciekio.php" class="btn btn-warning">Ścieki oczyszczone</a>
        
     </section>
 
     <section class="third-header-section">
         <a href="under_construction.php" class="btn btn-warning">Zmień hasło</a>
         <a href="logout.php" class="btn btn-error">Wyloguj</a>
     </section>
 </header>