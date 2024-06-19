#include "Tetris.h"
#include "Block.cpp"

Tetris::Tetris(int wX, int wY, int wW, int wH) {
	winX = wX;
	winY = wY;
	winW = wW;
	winH = wH;
	drawGridW = (((winW * 2) / 3) - gridPadding * 2) - (((winW * 2) / 3) % gridW);
	drawGridH = (winH - gridPadding * 2) - (drawGridH % gridH);
	drawBlockW = (drawGridW / gridW);
	drawBlockH = (drawGridH / gridH);
	init();
}
Tetris::~Tetris() {}

void Tetris::init() {
	srand((unsigned)time(NULL));

	if (SDL_Init(SDL_INIT_EVERYTHING) == 0) {
		std::cout << "SDL2 initialized." << std::endl;

		window = SDL_CreateWindow("Tetris", winX, winY, winW, winH, SDL_WINDOW_SHOWN);
		if (window) {
			std::cout << "window created..." << std::endl;
		}


		renderer = SDL_CreateRenderer(window, -1, 0);
		if (renderer) {
			setDrawColor(50, 50, 50, 200);
			std::cout << "render created..." << std::endl;
		}

		clearGrid();


		isRunning = true;
	}
	else {

		isRunning = false;
	}


}


// ================================  EVENT HANDLING  ========================================
void Tetris::handleEvents() {
	SDL_Event event;
	SDL_PollEvent(&event);
	switch (event.type) {
	case SDL_QUIT:
		isRunning = false;
		break;

	case SDL_KEYDOWN:
		switch (event.key.keysym.sym) {
		case SDLK_d:
			moveBlock(1);
			break;

		case SDLK_a:
			moveBlock(-1);
			break;

		case SDLK_s:
			update();
			break;

		case SDLK_c:
			clearGrid();
			break;

		case SDLK_w:
			rotateBlock();
			break;

		case SDLK_ESCAPE:
		case SDL_QUIT:
			isRunning = false;
			break;
		}

	default:
		break;
	}
}

void Tetris::moveBlock(int dir) {
	//tetris rotations ARE actually stupiddddllyyyy harrdddd
	bool atWall = false;
	for (int y = sizeof(grid) / sizeof(grid[0]) - 1; y >= 0; y--) { //scan if the blocks is already side to side with the wall.
		for (int x = sizeof(grid[0]) / sizeof(grid[0][0]) - 1; x >= 0; x--) {
			if (grid[y][x] < 0) {
				if (((x + dir) < 0) || ((x + dir) >= gridW)) {
					atWall = true;
				}
				else if (grid[y][(x + dir)] > 0) {
					atWall = true;
				}

			}
		}
	}
	if (!atWall) {
		for (int y = sizeof(grid) / sizeof(grid[0]) - 1; y >= 0; y--) {
			int row[gridW];
			for (int x = sizeof(grid[0]) / sizeof(grid[0][0]) - 1; x >= 0; x--) {
				row[x] = grid[y][x];
			}
			for (int x = sizeof(grid[0]) / sizeof(grid[0][0]) - 1; x >= 0; x--) {
				if (row[(((gridW + x) - dir) % gridW)] < 0) {
					//if ((grid[y][x] > 0) && (row[((gridW + x) + dir) % gridW] < 0)) {
					grid[y][x] = row[((gridW + x) - dir) % gridW];

				}
				else if (grid[y][x] > 0) {

				}
				else {
					grid[y][x] = 0;
				}
			}
		}
	}
}

void Tetris::rotateBlock() {
	int x1 = INT16_MAX;
	int y1 = INT16_MAX;
	int x2 = INT16_MIN;
	int y2 = INT16_MIN;

	for (int y = 0; y < sizeof(grid) / sizeof(grid[0]); y++) {
		for (int x = 0; x < sizeof(grid[0]) / sizeof(grid[0][0]); x++) {
			if (grid[y][x] < 0) {
				x1 = std::min(x, x1);
				y1 = std::min(y, y1);
				x2 = std::max(x, x2);
				y2 = std::max(y, y2);
			}
		}
	}
	if (x1 == INT16_MAX) {
		return;
	}

	int w = x2 - x1 + 1;
	int h = y2 - y1 + 1;
	int temp[4][4];

	for (int y = 0; y < h; y++) {// "cut" the falling block into a temporary array
		for (int x = 0; x < w; x++) {
			//temp[y][x] = 0;
			if (w % 2) { // rotation based on width if even or odd
				if (grid[y1 + (h - y - 1)][x1 + x] < 0) {
					temp[x][y] = grid[y1 + (h - y - 1)][x1 + x];
				}

			}
			else {

				if (grid[y1 + (h - y - 1)][x1 + x] < 0) {
					temp[x][y] = grid[y1 + (h - y - 1)][x1 + x];

				}
			}
			std::cout << temp[y][x];
			//temp[y][x] = -1;
		}
		std::cout << std::endl;
	}

	//if ((w % 2) && !(h%2)) { x1++; }
	//else { x1++; }
	bool hit = false;
	for (int y = 0; y < 4; y++) {// "cut" the falling block into a temporary array
		for (int x = 0; x < 4; x++) {

			if (temp[y][x] < 0 && temp[y][x] > -10) {
				if ((x1 + x < 0) || (x1 + x >= gridW)) {
					return; //cant rotate. just return. do nothing
				}
				else if (grid[y1 + y][x1 + x] > 0) {
					return;
				}

			}
		}
	}
	for (int y = 0; y < 4; y++) {
		for (int x = 0; x < 4; x++) {

			if (temp[y][x] < 0 && temp[y][x] > -10) {
				grid[y1 + y][x1 + x] = temp[y][x];
			}
			else if (grid[y1 + y][x1 + x] > 0) {
			}
			else {
				grid[y1 + y][x1 + x] = 0;
			}
		}

	}

	// rotation logic
	/*
				01  1000 if w is even
				01  1110		3 4 ...
				11  0000 //scan 1 2
					0000

				56	135
				34	246
				12


				100 if w is odd		 2 4
				111				scan 1 3

				456 14
				123	25
					36

				*/
}

void Tetris::clearGrid() {
	for (int y = 0; y < sizeof(grid) / sizeof(grid[0]); y++) {
		for (int x = 0; x < sizeof(grid[0]) / sizeof(grid[0][0]); x++) {
			grid[y][x] = 0;
		}
	}
}

// ===================================  UPDATE  ============================================
void Tetris::update() {
	bool landed = false;
	bool dropCheck = false;
	int bringDown = 0;

	for (int y = sizeof(grid) / sizeof(grid[0]) - 1; y >= 0; y--) {
		bool spacePresent = false;
		bool frozenPresent = false;
		bool fallingPresent = false;
		for (int x = sizeof(grid[0]) / sizeof(grid[0][0]) - 1; x >= 0; x--) {	// loop for checking, dropping and frezzing falling block
			if (grid[y][x] < 0) {
				fallingPresent = true;
				dropCheck = true;
				if ((y + 1 >= gridH) || (grid[(y + 1)][x] > 0) || landed) {
					grid[y][x] = abs(grid[y][x]); //freeze block
					if (!landed) { y = sizeof(grid) / sizeof(grid[0]) - 1; } //rescan lines if trigger somehow happens at last
					landed = true;
				}
			}
			if (grid[y][x] > 0) {
				frozenPresent = true;
			}
			else if (grid[y][x] == 0) {
				spacePresent = true;
			}
		}

		for (int x = sizeof(grid[0]) / sizeof(grid[0][0]) - 1; x >= 0; x--) { // if theres falling block, move it down.
			if (grid[y][x] < 0 && !(y >= gridH)) {
				grid[(y + 1)][x] = grid[y][x];
				grid[y][x] = 0;
			}
			else if ((frozenPresent && !spacePresent && !fallingPresent) || bringDown) { // filled row detected
				grid[y][x] = 0;
				if (grid[y - 1][x] > 0 && y > 0) {
					grid[y][x] = grid[y - 1][x];
					grid[y - 1][x] = 0;
				}
				bringDown++;

				//if (y < gridH) { y++; }

			}
		}


	}
	if (landed || !dropCheck) {
		dropWaitingBlock();
		newBlock();
	}
}

void Tetris::newBlock() {
	previewBlock = rand() % 7;
	//previewBlock = 7;
}

void Tetris::dropWaitingBlock() {

	for (int y = 0; y < 4; y++) {
		for (int x = 0; x < 4; x++) {
			if (blocks[previewBlock][y][x] != 0) {
				grid[y][x + (gridW / 3)] = blocks[previewBlock][y][x] * -1;
			}

		}
	}
}

// ===============================  DRAWING AND RENDERING  =================================
void Tetris::render() {
	SDL_RenderClear(renderer);
	setDrawColor(50, 50, 50, 200);
	SDL_RenderFillRect(renderer, rect(0, 0, winW, winH));

	drawGrid();

	drawBlocks();

	drawPreviewBlock();


	setDrawColor(0, 255, 0, 255);


	setDrawColor(0, 0, 0, 255);


	SDL_RenderPresent(renderer);
}

void Tetris::drawGrid() {

	setDrawColor(255, 0, 0, 255);
	SDL_RenderDrawRect(renderer, rect(gridPadding, gridPadding, drawGridW, winH - gridPadding * 2));
	setDrawColor(255, 255, 255, 255);


	for (int x = 0; x <= drawGridW; x += (drawGridW / gridW)) {
		SDL_RenderDrawLine(renderer, x + gridPadding, gridPadding, x + gridPadding, winH - gridPadding);
	}

	for (int y = 0; y <= drawGridH; y += (drawGridH / gridH)) {
		SDL_RenderDrawLine(renderer, gridPadding, y + gridPadding, drawGridW + gridPadding, y + gridPadding);
	}
}

void Tetris::drawBlocks() {
	for (int y = 0; y < sizeof(grid) / sizeof(grid[0]); y++) {
		for (int x = 0; x < sizeof(grid[0]) / sizeof(grid[0][0]); x++) {
			if (grid[y][x] != 0) {
				setBlockColor(abs(grid[y][x]));
				int xPos = (x * drawBlockW) + gridPadding + 1;
				int yPos = (y * drawBlockH) + gridPadding + 1;
				SDL_RenderFillRect(renderer, rect(xPos, yPos, drawBlockW - 1, drawBlockH - 1));
			}
		}
	}
}

void Tetris::drawPreviewBlock() {
	for (int y = 0; y < 4; y++) {
		for (int x = 0; x < 4; x++) {
			if (blocks[previewBlock][y][x] != 0) {
				setBlockColor(blocks[previewBlock][y][x]);
				int xPos = (x * drawBlockW) + gridPadding * 2 + drawGridW;
				int yPos = (y * drawBlockH) + gridPadding + drawBlockH;
				SDL_RenderFillRect(renderer, rect(xPos, yPos, drawBlockW - 1, drawBlockH - 1));
			}
		}
	}
}

// ==================================  MISCELLANEOUS  ======================================

SDL_Rect* Tetris::rect(int x, int y, int w, int h) {
	SDL_Rect r;
	r.x = x;
	r.y = y;
	r.w = w;
	r.h = h;
	return &r;
}

void Tetris::setDrawColor(int r, int g, int b, int a) {
	SDL_SetRenderDrawColor(renderer, r, g, b, a);
}

void Tetris::setBlockColor(int n) {
	int r = 255;
	int g = 255;
	int b = 255;
	int a = 255;
	switch (n) {
	case 1:
		r = 255;
		g = 0;
		b = 0;
		break;
	case 2:
		r = 0;
		g = 255;
		b = 0;
		break;
	case 3:
		r = 255;
		g = 255;
		b = 0;
		break;
	case 4:
		r = 0;
		g = 0;
		b = 255;
		break;
	case 5:
		r = 255;
		g = 0;
		b = 255;
		break;
	case 6:
		r = 200;
		g = 200;
		b = 200;
		break;
	case 7:
		r = 50;
		g = 100;
		b = 150;
		break;
	}
	setDrawColor(r, g, b, a);
}

void Tetris::exitTetris() {
	SDL_DestroyWindow(window);
	SDL_DestroyRenderer(renderer);
	SDL_Quit();

	std::cout << "exited." << std::endl;


}

bool Tetris::running() {
	return isRunning;
}