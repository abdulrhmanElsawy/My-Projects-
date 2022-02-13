// Main Variables

let theInput = document.querySelector(".get-repos input"),
    getButton = document.querySelector(".get-repos .get-button"),
    reposData = document.querySelector(".show-data");


getButton.onclick = function() {
    getRepos();
};

// Get Repos function
function getRepos() {
    if (theInput.value == "") { // IF value IS empty
        reposData.innerHTML = "<span style='color:red;'>Please Write GitHub Username</span>";

    } else {
        fetch(`https://api.github.com/users/${theInput.value}/repos`)
            .then((res) => {
                return res.json();
            })
            .then((repos) => {
                // Empty The Container
                reposData.innerHTML = '';

                // loop On Repositries
                repos.forEach(repo => {
                    // Create the main Div Element
                    let mainDiv = document.createElement("div");

                    // Create Repo name Text
                    let repoName = document.createTextNode(repo.name);

                    // Append The TeXT tO The Main Div
                    mainDiv.appendChild(repoName);

                    // Create Repo Url Anchor

                    let theUrl = document.createElement("a");

                    // Create Repo Link TeXT
                    let theUrlText = document.createTextNode("Visit");

                    // Append The Url Text to the Anchor Tag
                    theUrl.appendChild(theUrlText);
                    // Add the Hypertext Reference  "href"
                    theUrl.href = `https://github.com/${theInput.value}/${repo.name}`;
                    // Set Attribute Blank
                    theUrl.setAttribute("target", "_blank");

                    // Append Url Anchor To Main Div
                    mainDiv.appendChild(theUrl);

                    // Create Stars Count span
                    let starsSpan = document.createElement("span");

                    // Create the Stars Count Text
                    let starText = document.createTextNode(`Stars ${repo.stargazers_count}`);

                    // Add Stars Count Text To Stars Span
                    starsSpan.appendChild(starText);

                    // Add Stars Span to the MainDiv
                    mainDiv.appendChild(starsSpan);

                    // Add Class On Main Div
                    mainDiv.className = 'repo-box';

                    // Append The main Div TO the Container
                    reposData.appendChild(mainDiv);
                });
            });
    }
};