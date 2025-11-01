document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("search-input");
  const suggestionsDropdown = document.getElementById("suggestions-dropdown");

  if (!searchInput || !suggestionsDropdown) return;

  // Fonction pour masquer le dropdown
  const hideSuggestions = () => {
    suggestionsDropdown.style.display = "none";
    suggestionsDropdown.innerHTML = "";
  };

  // Fermer le dropdown si on clique n'importe où ailleurs
  document.addEventListener("click", (e) => {
    if (
      !searchInput.contains(e.target) &&
      !suggestionsDropdown.contains(e.target)
    ) {
      hideSuggestions();
    }
  });

  searchInput.addEventListener("input", (e) => {
    const query = e.target.value.trim();

    if (query.length < 2) {
      hideSuggestions();
      return;
    }

    // Requête AJAX vers le script PHP
    fetch(`suggest.php?q=${encodeURIComponent(query)}`)
      .then((response) => response.json())
      .then((data) => {
        displaySuggestions(data, query);
      })
      .catch((error) => {
        console.error("Erreur lors de la récupération des suggestions:", error);
        hideSuggestions();
      });
  });

  // Fonction pour afficher les résultats
  const displaySuggestions = (data, originalQuery) => {
    // Créer la structure <ul> pour la liste
    let ul = document.createElement("ul");
    ul.className = "list-group list-group-flush"; // Utilisez les classes Bootstrap pour un bel affichage

    let hasSuggestions = false;

    // --- 1. Résultats "Commence par" ---
    if (data.starts_with && data.starts_with.length > 0) {
      hasSuggestions = true;
      data.starts_with.forEach((term) => {
        ul.appendChild(createSuggestionItem(term, originalQuery));
      });
    }

    // --- 2. Séparation et Résultats "Contient" ---
    if (data.contains && data.contains.length > 0) {
      hasSuggestions = true;

      // Ajouter le séparateur si la première section n'était pas vide
      if (data.starts_with.length > 0) {
        let divider = document.createElement("li");
        // La petite séparation demandée
        divider.className =
          "list-group-item list-group-item-secondary text-muted small p-1";
        divider.textContent = "Résultats contenant votre recherche...";
        ul.appendChild(divider);
      }

      data.contains.forEach((term) => {
        ul.appendChild(createSuggestionItem(term, originalQuery));
      });
    }

    // Affichage final
    suggestionsDropdown.innerHTML = "";
    if (hasSuggestions) {
      suggestionsDropdown.appendChild(ul);
      suggestionsDropdown.style.display = "block";
    } else {
      hideSuggestions();
    }
  };

  // Fonction pour créer un lien de suggestion
  const createSuggestionItem = (term, query) => {
    let li = document.createElement("li");
    li.className = "list-group-item list-group-item-action suggestion-item";

    let a = document.createElement("a");
    // Le lien va soumettre le terme complet à la page de recherche
    a.href = `recherche.php?search=${encodeURIComponent(term)}`;
    a.style.display = "block";
    a.style.textDecoration = "none";
    a.style.color = "inherit";

    // Mettre en gras la partie de la recherche
    const regex = new RegExp(`(${query})`, "gi");
    a.innerHTML = term.replace(regex, "<strong>$1</strong>");

    li.appendChild(a);
    return li;
  };
});
