# 🏁 Dammen-Spel: Core Engine implementation

### 📝 Project Overview
This is a high-fidelity implementation of the classic Checkers (Dammen) game, developed as a terminal-based application. The project serves as a showcase of **Clean Code** and **Design Patterns** in PHP, focusing on a decoupled architecture where game rules are treated as independent, pluggable entities.

### 💻 Tech Stack
* **Language:** PHP 8.1+ (Strict types enabled)
* **Architecture:** Object-Oriented Programming (OOP)
* **Design Pattern:** Strategy-like Rule Validation System (RegelController)
* **Environment:** CLI-based (Optimized for VS Code Terminal)

### 🚀 Key Features & Logic
The engine is built around a complex 10-class system, with a dedicated **RegelController** that orchestrates 7 core game rules:

1.  **RegelDiagonaleZet:** Ensures movement is strictly diagonal and limited to 1 or 2 steps.
2.  **RegelSteenOpStartpositie:** Validates that a move begins from a square containing a piece.
3.  **RegelJuisteSpeler:** Enforces turn-based gameplay, ensuring players only move their own color.
4.  **RegelEindPositieLeeg:** Prevents moving to an already occupied square.
5.  **RegelSteenBeweegtVooruit:** Handles directional logic—regular pieces only move forward, while "Dam" (King) pieces gain multi-directional movement.
6.  **RegelSlaanBijSprong:** Implements capture logic, requiring an opponent's piece to be present for any 2-step jump.
7.  **RegelInterface Implementation:** Every rule follows a strict interface, allowing for easy expansion of the ruleset.

### 🧠 Technical Highlights
* **Advanced OOP:** Heavy use of abstraction (`AbstractSteen`) to differentiate between regular pieces and Kings (`Dam`).
* **Board Management:** A 10x10 grid system implemented via a `Bord` class that manages `Vak` (Square) objects and their states.
* **Input Parsing:** A robust `UserInterface` class that uses Regex to validate terminal commands (e.g., `1,6 2,5`).
* **State Control:** Automated board rendering in the terminal with ANSI escape codes for a clean, flicker-free experience.

### 🛠️ How to Run (VS Code Terminal)
1.  **Clone the project:**
    ```bash
    git clone [https://github.com/markpopa/Dammen-Spel.git](https://github.com/markpopa/Dammen-Spel.git)
    ```
2.  **Open in VS Code:**
    Open the project folder and launch the integrated terminal.
3.  **Launch the Game:**
    Run the entry point file directly using the PHP CLI:
    ```bash
    php dammen.php
    ```
4.  **Controls:**
    Enter your moves using the `X,Y X,Y` format (e.g., `3,6 4,5`). Type `exit` to quit the session.

---
*Developed as an advanced OOP exercise at NexEd.*